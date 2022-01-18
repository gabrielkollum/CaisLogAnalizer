<?php

namespace Src;

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
        
}