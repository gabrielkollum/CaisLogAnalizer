<?php

namespace Src;

use Exception;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class LogProcessing
{
    public static function clearBreakLine(string $log_folder, string $temp_folder): void
    {
        $files = self::onlyFiles($log_folder);

        foreach ($files as $file) {
            echo "Tratando o arquivo: " . $file . PHP_EOL;
            $content = file_get_contents($log_folder . $file);
            $replaced = preg_replace(["/[A-Z0-9.\-\_\s]{1}[\n]+/i", "/[\n]+[A-Z0-9.\-\_\s]{1}/i"], " ", $content);
            $result = fopen($temp_folder . "processed_" . $file, "w") or die("Nao deu");
            fwrite($result,$replaced);
            fclose($result);        
        }
        echo "Tratamentos dos arquivos finalizado!" . PHP_EOL;
    }

    public static function analize(string $processed_folder, string $destination)
    {
        $regex_send = "/Mensagem enviada ao Sigma/";
        $regex_refuse = "/Mensagem recusada:/";

        $files = self::onlyFiles($processed_folder);

        $analize = new AnalizeSheet();

        $count = 2;

        foreach ($files as $file ) {
            $log_content = file_get_contents($processed_folder . $file);
            $logs_file = file($processed_folder . $file);
            $total_send = preg_match_all($regex_send, $log_content);
            $total_refuse = preg_match_all($regex_refuse, $log_content);
            $total_message = $total_send + $total_refuse;

            echo($file . "\n");
            echo(" Total de mensagens aprovadas : " . $total_send . "\n");
            echo(" Total de mensagens recusadas : " . $total_refuse . "\n");
            echo(" TOTAL DE MENSAGENS : " . $total_message . "\n \n");

            $counter_time = new CounterTimeMessage();

            foreach ($logs_file as $log) {
                $space = str_replace(",", " ", $log);
                $replace = str_replace(["[", "]"],["", ","], $space);
                $parts = explode(",",$replace);

                if (preg_match($regex_send, $log) || preg_match($regex_refuse, $log)){
                    // if (! is_array($parts) || count($parts) < 4) continue;
                    try {
                        $time = new Carbon($parts[0]);

                    } catch (Exception $e) {
                        var_dump($file);
                        var_dump($log);
                        var_dump(substr($parts[0], 1));
                        exit(PHP_EOL . " SCRIPT INTERROMPIDO! " . PHP_EOL . $e);
                    }

                    $counter_time->compareTime($time);

                }

            }
            // var_dump($counter_time->getInterval());

            $analize->writeCounter($count, $total_send, $total_refuse, $total_message, $file, $counter_time->getInterval());

            $count ++ ;
        }


        $writer = new Xlsx($analize->getSpreadsheet());
        $writer->save('Analise.xlsx');
    }

    public static function onlyFiles($folder)
    {
       return array_filter(scandir($folder, 1), function($item) {
            return ! is_dir($item);
        });
    }
}