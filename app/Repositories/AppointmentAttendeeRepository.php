<?php

namespace App\Repositories;

use App\Models\AppointmentAttendee;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AppointmentAttendeeRepository.
 */
class AppointmentAttendeeRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return AppointmentAttendee::class;
    }

    public function store(array $data)
    {
        return $this->model()::create($data);
    }
}
