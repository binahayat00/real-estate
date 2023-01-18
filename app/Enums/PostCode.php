<?php

namespace App\Enums;

use App\Repositories\DefineRepository;

enum PostCode
{
    case response;
    case distanceUnit;
    case realtorZipcode;

    public function default(): ?string
    {
        return match($this){
            self::response => '200',
            self::distanceUnit => 'meter',
            self::realtorZipcode => (new DefineRepository)->getByName('realtor_zipcode'),
            
        };
    }
}