<?php

namespace Src;

use Carbon\Carbon;

class CounterTimeMessage
{
    private $interval = [
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

    protected $zero_start;
    protected $zero_end;
     
    protected $one_start;
    protected $one_end;
 
    protected $two_start;
    protected $two_end;
 
    protected $three_start;
    protected $three_end;
 
    protected $four_start;
    protected $four_end;
 
    protected $five_start;
    protected $five_end;
 
    protected $six_start;
    protected $six_end;
 
    protected $seven_start;
    protected $seven_end;
 
    protected $eight_start;
    protected $eight_end;
 
    protected $nine_start;
    protected $nine_end;
 
    protected $ten_start;
    protected $ten_end;
 
    protected $eleven_start;
    protected $eleven_end;
 
    protected $twelve_start;
    protected $twelve_end;
 
    protected $thirteen_start;
    protected $thirteen_end;
 
    protected $fourteen_start;
    protected $fourteen_end;
 
    protected $fifteen_start;
    protected $fifteen_end;
 
    protected $sixteen_start;
    protected $sixteen_end;
 
    protected $seventeen_start;
    protected $seventeen_end;
 
    protected $eighteen_start;
    protected $eighteen_end;
 
    protected $nineteen_start;
    protected $nineteen_end;
 
    protected $twenty_start;
    protected $twenty_end;
 
    protected $twenty_one_start;
    protected $twenty_one_end;
 
    protected $twenty_two_start;
    protected $twenty_two_end;
 
    protected $twenty_three_start;
    protected $twenty_three_end;
    
    public function __construct() {

        $this->zero_start = new Carbon("00:00:00.000");
        $this->zero_end = new Carbon("00:59:59.999");
         
        $this->one_start = new Carbon("01:00:00.000");
        $this->one_end = new Carbon("01:59:59.999");
     
        $this->two_start = new Carbon("02:00:00.000");
        $this->two_end = new Carbon("02:59:59.999");
     
        $this->three_start = new Carbon("03:00:00.000");
        $this->three_end = new Carbon("03:59:59.999");
     
        $this->four_start = new Carbon("04:00:00.000");
        $this->four_end = new Carbon("04:59:59.999");
     
        $this->five_start = new Carbon("05:00:00.000");
        $this->five_end = new Carbon("05:59:59.999");
     
        $this->six_start = new Carbon("06:00:00.000");
        $this->six_end = new Carbon("06:59:59.999");
     
        $this->seven_start = new Carbon("07:00:00.000");
        $this->seven_end = new Carbon("07:59:59.999");
     
        $this->eight_start = new Carbon("08:00:00.000");
        $this->eight_end = new Carbon("08:59:59.999");
     
        $this->nine_start = new Carbon("09:00:00.000");
        $this->nine_end = new Carbon("09:59:59.999");
     
        $this->ten_start = new Carbon("10:00:00.000");
        $this->ten_end = new Carbon("10:59:59.999");
     
        $this->eleven_start = new Carbon("11:00:00.000");
        $this->eleven_end = new Carbon("11:59:59.999");
     
        $this->twelve_start = new Carbon("12:00:00.000");
        $this->twelve_end = new Carbon("12:59:59.999");
     
        $this->thirteen_start = new Carbon("13:00:00.000");
        $this->thirteen_end = new Carbon("13:59:59.999");
     
        $this->fourteen_start = new Carbon("14:00:00.000");
        $this->fourteen_end = new Carbon("14:59:59.999");
     
        $this->fifteen_start = new Carbon("15:00:00.000");
        $this->fifteen_end = new Carbon("15:59:59.999");
     
        $this->sixteen_start = new Carbon("16:00:00.000");
        $this->sixteen_end = new Carbon("16:59:59.999");
     
        $this->seventeen_start = new Carbon("17:00:00.000");
        $this->seventeen_end = new Carbon("17:59:59.999");
     
        $this->eighteen_start = new Carbon("18:00:00.000");
        $this->eighteen_end = new Carbon("18:59:59.999");
     
        $this->nineteen_start = new Carbon("19:00:00.000");
        $this->nineteen_end = new Carbon("19:59:59.999");
     
        $this->twenty_start = new Carbon("20:00:00.000");
        $this->twenty_end = new Carbon("20:59:59.999");
     
        $this->twenty_one_start = new Carbon("21:00:00.000");
        $this->twenty_one_end = new Carbon("21:59:59.999");
     
        $this->twenty_two_start = new Carbon("22:00:00.000");
        $this->twenty_two_end = new Carbon("22:59:59.999");
     
        $this->twenty_three_start = new Carbon("23:00:00.000");
        $this->twenty_three_end = new Carbon("23:59:59.999");
    }

    public function getInterval(): array
    {
        return $this->interval;
    }

    public function compareTime(Carbon $time): void
    {
        if ($time->betweenIncluded($this->zero_start, $this->zero_end) ) {
            $this->interval["00:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->one_start, $this->one_end)) {
            $this->interval["01:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->two_start, $this->two_end)) {
            $this->interval["02:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->three_start, $this->three_end)) {
            $this->interval["03:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->four_start, $this->four_end)) {
            $this->interval["04:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->five_start, $this->five_end)) {
            $this->interval["05:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->six_start, $this->six_end)) {
            $this->interval["06:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->seven_start, $this->seven_end)) {
            $this->interval["07:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->eight_start, $this->eight_end)) {
            $this->interval["08:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->nine_start, $this->nine_end)) {
            $this->interval["09:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->ten_start, $this->ten_end)) {
            $this->interval["10:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->eleven_start, $this->eleven_end)) {
            $this->interval["11:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->twelve_start, $this->twelve_end)) {
            $this->interval["12:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->thirteen_start, $this->thirteen_end)) {
            $this->interval["13:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->fourteen_start, $this->fourteen_end)) {
            $this->interval["14:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->fifteen_start, $this->fifteen_end)) {
            $this->interval["15:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->sixteen_start, $this->sixteen_end)) {
            $this->interval["16:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->seventeen_start, $this->seventeen_end)) {
            $this->interval["17:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->eighteen_start, $this->eighteen_end)) {
            $this->interval["18:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->nineteen_start, $this->nineteen_end)) {
            $this->interval["19:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->twenty_start, $this->twenty_end)) {
            $this->interval["20:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->twenty_one_start, $this->twenty_one_end)) {
            $this->interval["21:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->twenty_two_start, $this->twenty_two_end)) {
            $this->interval["22:00"] ++ ;
            return;
        }

        if ($time->betweenIncluded($this->twenty_three_start, $this->twenty_three_end)) {
            $this->interval["23:00"] ++ ;
            return;
        }

        exit ( "\n\n\n\n" . "ESSE AQUI DEU MERDA " . $time->toTimeString() ."\n\n\n\n" );
    }
}