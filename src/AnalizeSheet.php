<?php

namespace Src;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class AnalizeSheet
{
    public $sheet;
    protected $spreadsheet;


    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
        $sheet = $this->spreadsheet->getActiveSheet();
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
        $this->sheet = $sheet;
    }

    public function getSpreadsheet(): Spreadsheet
    {
        return $this->spreadsheet;
    }

    public function writeCounter(int $count, int $total_send, int $total_refuse, int $total_message, string $log_name, array $interval): void
    {
        $this->sheet->setCellValue('A' . $count, $log_name);
        $this->sheet->setCellValue('B' . $count, $total_send );
        $this->sheet->setCellValue('C' . $count, $total_refuse);
        $this->sheet->setCellValue('D' . $count, $total_message);
        $this->sheet->setCellValue('F' . $count, $interval['01:00']);
        $this->sheet->setCellValue('G' . $count, $interval['02:00']);
        $this->sheet->setCellValue('H' . $count, $interval['03:00']);
        $this->sheet->setCellValue('E' . $count, $interval['00:00']);
        $this->sheet->setCellValue('I' . $count, $interval['04:00']);
        $this->sheet->setCellValue('J' . $count, $interval['05:00']);
        $this->sheet->setCellValue('K' . $count, $interval['06:00']);
        $this->sheet->setCellValue('L' . $count, $interval['07:00']);
        $this->sheet->setCellValue('M' . $count, $interval['08:00']);
        $this->sheet->setCellValue('N' . $count, $interval['09:00']);
        $this->sheet->setCellValue('O' . $count, $interval['10:00']);
        $this->sheet->setCellValue('P' . $count, $interval['11:00']);
        $this->sheet->setCellValue('Q' . $count, $interval['12:00']);
        $this->sheet->setCellValue('R' . $count, $interval['13:00']);
        $this->sheet->setCellValue('S' . $count, $interval['14:00']);
        $this->sheet->setCellValue('T' . $count, $interval['15:00']);
        $this->sheet->setCellValue('U' . $count, $interval['16:00']);
        $this->sheet->setCellValue('V' . $count, $interval['17:00']);
        $this->sheet->setCellValue('W' . $count, $interval['18:00']);
        $this->sheet->setCellValue('X' . $count, $interval['19:00']);
        $this->sheet->setCellValue('Y' . $count, $interval['20:00']);
        $this->sheet->setCellValue('Z' . $count, $interval['21:00']);
        $this->sheet->setCellValue('AA' . $count, $interval['22:00']);
        $this->sheet->setCellValue('AB' . $count, $interval['23:00']);
    }

    public function newWorksheet(string $month)
    {
        $new_sheet = $this->spreadsheet->createSheet();
        $new_sheet->setTitle($month);
        $new_sheet->getDefaultColumnDimension()->setWidth(0.73, 'cm');
        $new_sheet->setCellValue('A1', 'Operador');
    }

    public function worksheet(string $date)
    {
        $time = new Carbon($date);
        $month = Month::from($time->month)->string();

        $worksheet = $this->spreadsheet->getSheetByName($month) ?? false;

        if (! $worksheet) {
            $worksheet = $this->spreadsheet->createSheet();
            $worksheet->setTitle($month);
            $worksheet->getDefaultColumnDimension()->setWidth(0.73, 'cm');
            $worksheet->setCellValue('A1', 'Operador');

            return [$this->spreadsheet->getSheetByName($month), $month];
        }
        
        return [$worksheet, $month];

    }

    public function writeIndividualStatistic(array $final_statistic): void
    {
        $statistic_sheet = $this->spreadsheet->createSheet();
        $statistic_sheet->setTitle("Estatisticas Individuais");
        $statistic_sheet->getDefaultColumnDimension()->setWidth(0.73, 'cm');
        $statistic_sheet->setCellValue('A1', 'Operador');

        $column_counter = [];
        $column = 2;
        $opr_row = [];
        $row_counter = 2;

        $date_counter = [];

        foreach ($final_statistic as $date => $data) {

            [$statistic_sheet, $month] = $this->worksheet($date);



            if (! array_key_exists($month, $column_counter)) {
                $column_counter[$month] = 2;
            }


            $sn_column = $column_counter[$month];
            $d_column = $column_counter[$month] + 1;
            $en_column = $column_counter[$month] + 2;

            if (! in_array($date , $date_counter)) {
                $date_counter[] = $date;

                $statistic_sheet->setCellValueByColumnAndRow($column_counter[$month], 1, $date);
                $statistic_sheet->mergeCellsByColumnAndRow($column_counter[$month], 1, ($column_counter[$month] + 2), 1);
                $statistic_sheet->setCellValueByColumnAndRow($sn_column, 2, 'SN');
                $statistic_sheet->setCellValueByColumnAndRow($d_column , 2, 'D');
                $statistic_sheet->setCellValueByColumnAndRow($en_column, 2, 'EN');

            }
            // if (! $index == 0) {
            //     $column_counter[$month]+= 3;
            // }

            // var_dump($column_counter[$month]);
            // exit();
            // $index == 0 ? "" : $column += 3;



            foreach ($data as $operator_name => $count) {
 
                if (! array_key_exists($month, $opr_row)) {
                    $opr_row[$month] = [];

                }

                if (! in_array($operator_name, $opr_row[$month])) {
                    $row_counter++;
                    $opr_row[$month][] = $operator_name;
                    $statistic_sheet->setCellValueByColumnAndRow(1, array_search($operator_name, $opr_row[$month]) + 3, $operator_name);
                    // array_push($opr_row[$month], $operator_name);
                    // $opr_row[$month][$operator_name] = $row_counter;
                    // $statistic_sheet->setCellValueByColumnAndRow(1, $opr_row[$month][$operator_name], $operator_name);
                }

                $row = array_search($operator_name, $opr_row[$month]) + 3;
                // var_dump();
                // exit();

                foreach($count as $turn => $amount) {
 
                    switch ($turn) {
                        case 'SN':
                            $statistic_sheet->setCellValueByColumnAndRow($sn_column, $row, $amount);
                            break;
                        case 'D':
                            $statistic_sheet->setCellValueByColumnAndRow($d_column, $row, $amount);
                            break;
                        case 'EN':
                            $statistic_sheet->setCellValueByColumnAndRow($en_column, $row, $amount);
                            break;

                    }
                }
            }

            $column_counter[$month] += 3;

        }

        // var_dump($opr_row['dezembro']);
        // foreach($opr_row['dezembro'] as $test) {
        //     echo($test . PHP_EOL);
        // }
        // exit();
    }        
}