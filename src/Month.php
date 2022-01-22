<?php
namespace Src;

enum Month : int
{
    case SEPTEMBER = 9;
    case OCTUBER = 10;
    case NOVEMBER = 11;
    case DECEMBER = 12;

    public function string() : string
    {
        return match($this) 
        {
            self::SEPTEMBER => 'setembro',   
            self::OCTUBER => 'outubro',   
            self::NOVEMBER => 'novembro',   
            self::DECEMBER => 'dezembro', 
        };
    }
}