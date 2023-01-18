<?php

namespace App\Enums;

enum PostCode
{
    case response;
    case distanceUnit;

    public function default(): ?string
    {
        return match($this){
            self::response => '200',
            self::distanceUnit => 'meter',
        };
    }
}