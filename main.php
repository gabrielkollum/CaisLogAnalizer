<?php

require __DIR__ . "/vendor/autoload.php";

use Carbon\Carbon;

$logs_dir = __DIR__ . "/logs/";
$temp_dir =  __DIR__ . "/temp/";

$files = array_filter(scandir($temp_dir), function ($temp_dir) {
    return ! is_dir($temp_dir);
}) ;

foreach ($files as $file) {
    $content = file_get_contents($logs_dir . $file);
    $replaced = preg_replace(["/[A-Z0-9.\-\_\s]{1}[\n]+/i", "/[\n]+[A-Z0-9.\-\_\s]{1}/i"], " ", $content);

    $result = fopen($temp_dir . "teste_" . $file, "w") or die("Nao deu");
    fwrite($result,$replaced);
    fclose($result);

    // print_r("Arquivo " . $file . " completo! \n");

    /**
     * teste dos arquivos
     */

    //  $line_content = file($temp_dir . $file);

    //  foreach ($line_content as $line) {
    //      try {

    //         $replace = str_replace("[]", " ", $line);
    //         $brackets = str_replace(["[", "]"],["", ","], $replace);
    //         $exploded = explode(",",$brackets);
    //         // var_dump($exploded);
    //         $carbon = new Carbon($exploded[0]);
    //         if (count($exploded) >= 9) {
    //             var_dump($exploded);

    //         }
    //      } catch (Exception $e) {
    //         print_r($line . "\n" . $e);

    //      }
    //  }

}


// $replaced = str_replace([" \n","\n\n", "\n\n\n", "\n \n \n","\n \n","\n \n "," \n \n "," \n \n", "\n ", "\n -", "\n-", " \n -", " \n - "],[ "*1*"], $content);
// $replaced = preg_replace(["/[A-Z0-9.\-\_\s]{1}[\n]+/", "/[\n]+[A-Z0-9.\-\_\s]{1}/"], "*1*", $content);


// $more = preg_replace(["/[A-Z]\n[A-Z]/","/[A-Z]\s\n[A-Z]/", "/[0-9]\n[0-9]/", "/[A-Z]\r[A-Z]/","/[A-Z]\s\r[A-Z]/", "/[0-9]\r[0-9]/", "/[A-Z]\s\n/", "/\n\s[A-Z]/"], "*2*", $replaced);

// $more = preg_replace(["/[A-Z0-9]?[\n]+[A-Z0-9]?/i"], "*2*", $replaced);


// $result = fopen("teste.log", "w") or die("Nao deu");
// fwrite($result,$replaced);
// fclose($result);
