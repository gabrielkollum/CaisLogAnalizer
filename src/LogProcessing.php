<?php

namespace Src;

use Exception;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class LogProcessing
{

    public static function clearBreakLine(string $log_folder, string $temp_folder): void
    {
        $logs = self::onlyFiles($log_folder);
        $temp = self::onlyFiles($temp_folder);

        $logs = array_filter($logs, function($log) use ($temp) {
            return !in_array($log, $temp);
         });


        foreach ($logs as $file) {
            echo "Tratando o arquivo: " . $file . PHP_EOL;
            $content = file_get_contents($log_folder . $file);
            $replaced = preg_replace(["/[A-Z0-9.\-\_\s]{1}[\n]+/i", "/[\n]+[A-Z0-9.\-\_\s]{1}/i"], " ", $content);
            $result = fopen($temp_folder . $file, "w") or die("Nao deu");
            fwrite($result,$replaced);
            fclose($result);        
        }
        echo PHP_EOL . "Tratamentos dos arquivos finalizado!" . PHP_EOL;
    }

    public static function analize(string $processed_folder, string $destination):void
    {
  
        $analize = self::scanFiles($processed_folder);

        $writer = new Xlsx($analize->getSpreadsheet());
        $extension = '.xlsx';
        $file_name = 'Analise';
    
        $exists_file = in_array($file_name . $extension,scandir($destination));

        if ($exists_file) {
            for ($i=1;;$i++) {
                $new_file_name = $file_name .'('.$i.')'.$extension;
                if(! in_array($new_file_name,scandir($destination))) {
                    $writer->save($destination . $new_file_name);
                    break;
                }
            }
        } else {
            $path_name = $destination . $file_name . $extension;
            $writer->save($path_name);
        }

    }

    public static function onlyFiles($folder):array
    {
       return array_filter(scandir($folder,SCANDIR_SORT_ASCENDING), function($item) {
            return ! is_dir($item);
        });
    }

    private static function scanFiles(string $processed_folder) : AnalizeSheet
    {
        $regex_send = "/Mensagem enviada ao Sigma/";
        $regex_refuse = "/Mensagem recusada:/";

        $files = self::onlyFiles($processed_folder);

        $analize = new AnalizeSheet();
        $final_statistic = [];

        $count = 2;

        foreach ($files as $file ) {
            $log_content = file_get_contents($processed_folder . $file);
            $logs_file = file($processed_folder . $file);
            $total_send = preg_match_all($regex_send, $log_content);
            $total_refuse = preg_match_all($regex_refuse, $log_content);
            $total_message = $total_send + $total_refuse;
            $file_name = str_replace(".log", "",$file);
            // array_push($final_statistc, $final_statistc[$file_name][]);

            // echo($file . "\n");
            // echo(" Total de mensagens aprovadas : " . $total_send . "\n");
            // echo(" Total de mensagens recusadas : " . $total_refuse . "\n");
            // echo(" TOTAL DE MENSAGENS : " . $total_message . "\n \n");

            $counter_time = new CounterTimeMessage();

            $operators = [];
            foreach ($logs_file as $log) {
                $space = str_replace(",", " ", $log);
                $replace = str_replace(["[", "]"],["", ","], $space);
                $parts = explode(",",$replace);

                if (preg_match($regex_send, $log) || preg_match($regex_refuse, $log)){
                    try {
                        $time = new Carbon($parts[0]);
                    } catch (Exception $e) {
                        var_dump($file);
                        var_dump($log);
                        var_dump(substr($parts[0], 1));
                        exit(PHP_EOL . " SCRIPT INTERROMPIDO! " . PHP_EOL . $e);
                    }
                    $counter_time->compareTime($time);

                    if (! array_key_exists($parts[2], $operators)) {
                        $operators[$parts[2]] = [$time];
                    } else {
                       array_push($operators[$parts[2]], $time);
                    }
                    
                }           

            }
            
            $statistic[$file_name] = [];
            $start_daylight = new Carbon("10:00:00");
            $end_daylight = new Carbon("22:00:00");
            foreach($operators as $operator => $times) {
                foreach ($times as $time) {
                    if ($time->betweenIncluded($start_daylight, $end_daylight)){
                        if  (! array_key_exists($operator, $statistic[$file_name])){
                            $statistic[$file_name][$operator] = ["D" => 1];
                        } else {
                            array_key_exists("D",$statistic[$file_name][$operator]) ? $statistic[$file_name][$operator]["D"]++ : $statistic[$file_name][$operator] = ["D" => 1] ;
                        }
                    } elseif ($time->lessThan($start_daylight)) {
                        if  (! array_key_exists($operator, $statistic[$file_name])){
                            $statistic[$file_name][$operator] = ["SN" => 1];
                        } else {
                            array_key_exists("SN",$statistic[$file_name][$operator]) ? $statistic[$file_name][$operator]["SN"]++ : $statistic[$file_name][$operator] = ["SN" => 1] ;
                        }
                    } elseif ($time->greaterThan($start_daylight)) {

                        if  (! array_key_exists($operator, $statistic[$file_name])){
                            
                        } else {
                            array_key_exists("EN",$statistic[$file_name][$operator]) ? $statistic[$file_name][$operator]["EN"]++ : $statistic[$file_name][$operator] = ["EN" => 1] ;
                        }
                    } 
                }
            }
            // var_dump($statistic);
            array_push($final_statistic, $statistic);

            $analize->writeCounter($count, $total_send, $total_refuse, $total_message, $file_name, $counter_time->getInterval());


            
            $count ++ ;
        }

        // var_dump($final_statistic);
        $analize->writeIndividualStatistic($final_statistic);

        return $analize;
    }
}