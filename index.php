<?php

require __DIR__ . "/vendor/autoload.php";

use Src\LogProcessing;


$logs_dir = __DIR__ . "/logs/";
$temp_dir =  __DIR__ . "/temp/processed/";
$destination = __DIR__ . "/tables/";



LogProcessing::clearBreakLine($logs_dir, $temp_dir);

LogProcessing::analize($temp_dir, $destination);


exit(PHP_EOL . "Terminamos aqui" . PHP_EOL);



?>