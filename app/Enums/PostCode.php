<?php

namespace App\Enums;

enum PostCode
{
    case response;

    public function default(): ?string
    {
        return match($this){
            self::response => '200',
        };
    }
}