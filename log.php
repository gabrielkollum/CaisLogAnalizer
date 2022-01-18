<?php

require __DIR__ . "/vendor/autoload.php";

use Carbon\Carbon;
use Src\AnalizeSheet;
use Src\LogProcessing;
use Src\CounterTimeMessage;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// $filename = readline("Nome do arquivo: ");

$logs_dir = __DIR__ . "/logs/";
$temp_dir =  __DIR__ . "/temp/processed/";



LogProcessing::clearBreakLine($logs_dir, $temp_dir);

LogProcessing::analize($temp_dir, getcwd());


exit("Terminamos aqui \n");






$dir = getcwd() . "/logs/";

$files = array_filter(scandir($dir, 1), function($item) {
    return !is_dir(getcwd() . "/logs/" . $item);
});

$analize = new AnalizeSheet();


$count = 2;

foreach ($files as $file ) {
    $log_content = file_get_contents("logs/" . $file);
    $log_name = $file;
    $total_send = preg_match_all("/Mensagem enviada ao Sigma/", $log_content);
    $total_refuse = preg_match_all("/Mensagem recusada/", $log_content);
    $total_message = $total_send + $total_refuse;

    $log_replace = str_replace("][S", " ", str_replace("[]" , " ", str_replace("\n", "", $log_content)));
    $log_exploded = explode("][", $log_replace);


    echo($file . "\n");
    echo(" Total de mensagens aprovadas : " . $total_send . "\n");
    echo(" Total de mensagens recusadas : " . $total_refuse . "\n");
    echo(" TOTAL DE MENSAGENS : " . $total_message . "\n \n");

    $counter_time = new CounterTimeMessage();

    for ($i=0; $i < count($log_exploded); $i+=4) {
        print_r($log_exploded[$i]. "\n");

        if (preg_match("/Mensagem enviada ao Sigma/", $log_exploded[$i]) || preg_match("/Mensagem recusada/", $log_exploded[$i])){

            try {

                $string_time = str_replace(["[", "]"], "", $log_exploded[$i - 3]);
                $time = new Carbon($string_time);

            } catch (Exception $e) {
                var_dump($file);
            }

            $index = 0;
            $counter_time->compareTime($time);

        }
    }

    break;




    // $logs = file_get_contents("logs/" . $file);
    // echo($file . "\n");
    // echo(" Total de mensagens aprovadas : " . $total_send . "\n");
    // echo(" Total de mensagens recusadas : " . $total_refuse . "\n");
    // echo(" TOTAL DE MENSAGENS : " . $total_message . "\n \n");

    // $counter_time = new CounterTimeMessage();


    // foreach ($filelog as $log) {
    //     $space = str_replace(",", " ", $log);
    //     $replace = str_replace(["[", "]"],["", ","], $space);
    //     $parts = explode(",",$replace);


    //     if (preg_match("/Mensagem enviada ao Sigma/", $log) || preg_match("/Mensagem recusada/", $log)){

    //         if (! is_array($parts) || count($parts) < 4) continue;


    //         try {
    //             $time = new Carbon($parts[0]);

    //         } catch (Exception $e) {
    //             var_dump($file);
    //             var_dump($log);
    //             var_dump(substr($parts[0], 1));
    //         }

            
    //         $counter_time->compareTime($time);

    //     }

    // }    

    // var_dump($counter_time->getInterval());

    // break;

    $analize->writeCounter($count, $total_send, $total_refuse, $total_message, $log_name, $counter_time->getInterval());

    $count ++ ;
}


$writer = new Xlsx($analize->getSpreadsheet());
$writer->save($filename .'.xlsx');

?>