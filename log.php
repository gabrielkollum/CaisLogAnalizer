<?php

require __DIR__ . "/vendor/autoload.php";

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$filename = readline("Nome do arquivo: ");
// echo($logs);

$dir = getcwd() . "/logs/";

$files = array_filter(scandir($dir, 1), function($item) {
    return !is_dir(getcwd() . "/logs/" . $item);
});




$zero_start = new Carbon("00:00:00");
$zero_end = new Carbon("00:59:59");

$one_start = new Carbon("01:00:00");
$one_end = new Carbon("01:59:59");

$two_start = new Carbon("02:00:00");
$two_end = new Carbon("02:59:59");

$three_start = new Carbon("03:00:00");
$three_end = new Carbon("03:59:59");

$four_start = new Carbon("04:00:00");
$four_end = new Carbon("04:59:59");

$five_start = new Carbon("05:00:00");
$five_end = new Carbon("05:59:59");

$six_start = new Carbon("06:00:00");
$six_end = new Carbon("06:59:59");

$seven_start = new Carbon("07:00:00");
$seven_end = new Carbon("07:59:59");

$eight_start = new Carbon("08:00:00");
$eight_end = new Carbon("08:59:59");

$nine_start = new Carbon("09:00:00");
$nine_end = new Carbon("09:59:59");

$ten_start = new Carbon("10:00:00");
$ten_end = new Carbon("10:59:59");

$eleven_start = new Carbon("11:00:00");
$eleven_end = new Carbon("11:59:59");

$twelve_start = new Carbon("12:00:00");
$twelve_end = new Carbon("12:59:59");

$thirteen_start = new Carbon("13:00:00");
$thirteen_end = new Carbon("13:59:59");

$fourteen_start = new Carbon("14:00:00");
$fourteen_end = new Carbon("14:59:59");

$fifteen_start = new Carbon("15:00:00");
$fifteen_end = new Carbon("15:59:59");

$sixteen_start = new Carbon("16:00:00");
$sixteen_end = new Carbon("16:59:59");

$seventeen_start = new Carbon("17:00:00");
$seventeen_end = new Carbon("17:59:59");

$eighteen_start = new Carbon("18:00:00");
$eighteen_end = new Carbon("18:59:59");

$nineteen_start = new Carbon("19:00:00");
$nineteen_end = new Carbon("19:59:59");

$twenty_start = new Carbon("20:00:00");
$twenty_end = new Carbon("20:59:59");

$twenty_one_start = new Carbon("21:00:00");
$twenty_one_end = new Carbon("21:59:59");

$twenty_two_start = new Carbon("22:00:00");
$twenty_two_end = new Carbon("22:59:59");

$twenty_three_start = new Carbon("23:00:00");
$twenty_three_end = new Carbon("23:59:59");




// echo(" Total de mensagens aprovadas : " . preg_match_all("/Mensagem enviada ao Sigma/", $logs) . "\n");
// echo(" Total de mensagens recusadas : " . preg_match_all("/Mensagem recusada/", $logs) . "\n");


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Data');
$sheet->setCellValue('B1', 'Mensagens enviadas');
$sheet->setCellValue('C1', 'Mensagem recusadas');
$sheet->setCellValue('D1', 'TOTAL');
$sheet->setCellValue('E1', '00:00');
$sheet->setCellValue('F1', '01:00');
$sheet->setCellValue('G1', '02:00');
$sheet->setCellValue('H1', '03:00');
$sheet->setCellValue('I1', '04:00');
$sheet->setCellValue('J1', '05:00');
$sheet->setCellValue('K1', '06:00');
$sheet->setCellValue('L1', '07:00');
$sheet->setCellValue('M1', '08:00');
$sheet->setCellValue('N1', '09:00');
$sheet->setCellValue('O1', '10:00');
$sheet->setCellValue('P1', '11:00');
$sheet->setCellValue('Q1', '12:00');
$sheet->setCellValue('R1', '13:00');
$sheet->setCellValue('S1', '14:00');
$sheet->setCellValue('T1', '15:00');
$sheet->setCellValue('U1', '16:00');
$sheet->setCellValue('V1', '17:00');
$sheet->setCellValue('W1', '18:00');
$sheet->setCellValue('X1', '19:00');
$sheet->setCellValue('Y1', '20:00');
$sheet->setCellValue('Z1', '21:00');
$sheet->setCellValue('AA1', '22:00');
$sheet->setCellValue('AB1', '23:00');




$count = 2;

foreach ($files as $file ) {
    $filelog = file("logs/" . $file);

    // $a = str_replace(["\n", "."], ["", ""], file_get_contents("logs/" . $file));
    // preg_match_all("\[(.*?)\]",$a , $some);
    // preg_match_all("/\[[^\]]*\]/",$a , $some);
    // $some = preg_split('/([.*?])/', $a , null, PREG_SPLIT_DELIM_CAPTURE);
    // var_dump($some);
    // echo(count($filelog) . "\n");

    $logs = file_get_contents("logs/" . $file);
    echo($file . "\n");
    echo(" Total de mensagens aprovadas : " . preg_match_all("/Mensagem enviada ao Sigma/", $logs) . "\n");
    echo(" Total de mensagens recusadas : " . preg_match_all("/Mensagem recusada/", $logs) . "\n");
    echo(" TOTAL DE MENSAGENS : " . ((int) preg_match_all("/Mensagem enviada ao Sigma/", $logs) + (int) preg_match_all("/Mensagem recusada/", $logs)) . "\n \n");

    $interval = [
        "00:00" => 0,
        "01:00" => 0,
        "02:00" => 0,
        "03:00" => 0,
        "04:00" => 0,
        "05:00" => 0,
        "06:00" => 0,
        "07:00" => 0,
        "08:00" => 0,
        "09:00" => 0,
        "10:00" => 0,
        "11:00" => 0,
        "12:00" => 0,
        "13:00" => 0,
        "14:00" => 0,
        "15:00" => 0,
        "16:00" => 0,
        "17:00" => 0,
        "18:00" => 0,
        "19:00" => 0,
        "20:00" => 0,
        "21:00" => 0,
        "22:00" => 0,
        "23:00" => 0,
        
    ];



    foreach ($filelog as $log) {
        $space = str_replace(",", " ", $log);
        $replace = str_replace(["[", "]"],["", ","], $space);
        $parts = explode(",",$replace);

        // $parts = explode("]", $log);
        
        if (preg_match("/Mensagem enviada ao Sigma/", $log) || preg_match("/Mensagem recusada/", $log)){
            // print_r(substr($parts[0], 1) );
            // print_r("\n");
 
            if (! is_array($parts) || count($parts) < 4) continue;


            try {
                $time = new Carbon($parts[0]);

            } catch (Exception $e) {
                var_dump($file);
                var_dump($log);
                var_dump(substr($parts[0], 1));
                // echo("CONTADOOOOOOOOOOOO:    " . count($parts));
            }
            // echo($time->toTimeString() ."\n");

            // print_r("\n");
            if ($time->betweenIncluded($zero_start, $zero_end) ) {
                $interval["00:00"] ++ ;
            }

            if ($time->betweenIncluded($one_start, $one_end)) {
                $interval["01:00"] ++ ;
            }

            if ($time->betweenIncluded($two_start, $two_end)) {
                $interval["02:00"] ++ ;
            }

            if ($time->betweenIncluded($three_start, $three_end)) {
                $interval["03:00"] ++ ;
            }

            if ($time->betweenIncluded($four_start, $four_end)) {
                $interval["04:00"] ++ ;
            }

            if ($time->betweenIncluded($five_start, $five_end)) {
                $interval["05:00"] ++ ;
            }

            if ($time->betweenIncluded($six_start, $six_end)) {
                $interval["06:00"] ++ ;
            }

            if ($time->betweenIncluded($seven_start, $seven_end)) {
                $interval["07:00"] ++ ;
            }
            
            if ($time->betweenIncluded($eight_start, $eight_end)) {
                $interval["08:00"] ++ ;
            }

            if ($time->betweenIncluded($nine_start, $nine_end)) {
                $interval["09:00"] ++ ;
            }

            if ($time->betweenIncluded($ten_start, $ten_end)) {
                $interval["10:00"] ++ ;
            }

            if ($time->betweenIncluded($eleven_start, $eleven_end)) {
                $interval["11:00"] ++ ;
            }

            if ($time->betweenIncluded($twelve_start, $twelve_end)) {
                $interval["12:00"] ++ ;
            }

            if ($time->betweenIncluded($thirteen_start, $thirteen_end)) {
                $interval["13:00"] ++ ;
            }

            if ($time->betweenIncluded($fourteen_start, $fourteen_end)) {
                $interval["14:00"] ++ ;
            }

            if ($time->betweenIncluded($fifteen_start, $fifteen_end)) {
                $interval["15:00"] ++ ;
            }

            if ($time->betweenIncluded($sixteen_start, $sixteen_end)) {
                $interval["16:00"] ++ ;
            }

            if ($time->betweenIncluded($seventeen_start, $seventeen_end)) {
                $interval["17:00"] ++ ;
            }

            if ($time->betweenIncluded($eighteen_start, $eighteen_end)) {
                $interval["18:00"] ++ ;
            }

            if ($time->betweenIncluded($nineteen_start, $nineteen_end)) {
                $interval["19:00"] ++ ;
            }

            if ($time->betweenIncluded($twenty_start, $twenty_end)) {
                $interval["20:00"] ++ ;
            }

            if ($time->betweenIncluded($twenty_one_start, $twenty_one_end)) {
                $interval["21:00"] ++ ;
            }
            if ($time->betweenIncluded($twenty_two_start, $twenty_two_end)) {
                $interval["22:00"] ++ ;
            }
            if ($time->betweenIncluded($twenty_three_start, $twenty_three_end)) {
                $interval["23:00"] ++ ;
            }
            
        }
        
    }
    $sheet->setCellValue('A' . $count, $file);
    $sheet->setCellValue('B' . $count, preg_match_all("/Mensagem enviada ao Sigma/", $logs) );
    $sheet->setCellValue('C' . $count, preg_match_all("/Mensagem recusada/", $logs));
    $sheet->setCellValue('D' . $count, ((int) preg_match_all("/Mensagem enviada ao Sigma/", $logs) + (int) preg_match_all("/Mensagem recusada/", $logs)));
    $sheet->setCellValue('F' . $count, $interval['01:00']);
    $sheet->setCellValue('G' . $count, $interval['02:00']);
    $sheet->setCellValue('H' . $count, $interval['03:00']);
    $sheet->setCellValue('E' . $count, $interval['00:00']);
    $sheet->setCellValue('I' . $count, $interval['04:00']);
    $sheet->setCellValue('J' . $count, $interval['05:00']);
    $sheet->setCellValue('K' . $count, $interval['06:00']);
    $sheet->setCellValue('L' . $count, $interval['07:00']);
    $sheet->setCellValue('M' . $count, $interval['08:00']);
    $sheet->setCellValue('N' . $count, $interval['09:00']);
    $sheet->setCellValue('O' . $count, $interval['10:00']);
    $sheet->setCellValue('P' . $count, $interval['11:00']);
    $sheet->setCellValue('Q' . $count, $interval['12:00']);
    $sheet->setCellValue('R' . $count, $interval['13:00']);
    $sheet->setCellValue('S' . $count, $interval['14:00']);
    $sheet->setCellValue('T' . $count, $interval['15:00']);
    $sheet->setCellValue('U' . $count, $interval['16:00']);
    $sheet->setCellValue('V' . $count, $interval['17:00']);
    $sheet->setCellValue('W' . $count, $interval['18:00']);
    $sheet->setCellValue('X' . $count, $interval['19:00']);
    $sheet->setCellValue('Y' . $count, $interval['20:00']);
    $sheet->setCellValue('Z' . $count, $interval['21:00']);
    $sheet->setCellValue('AA' . $count, $interval['22:00']);
    $sheet->setCellValue('AB' . $count, $interval['23:00']);

    $count ++ ;
    // var_dump($interval);
}


$writer = new Xlsx($spreadsheet);
$writer->save($filename .'.xlsx');

?>