<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Repositories\Interfaces\BaseInterface;

// use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AppointmentRepository.
 */
class AppointmentRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Appointment::class;
    }

    public function all()
    {
        return $this->model()::with('appointmentAttendee')->get();
    }

    public function show($id)
    {
        return $this->model()::where(['id' => $id])->with('appointmentAttendee')->first();
    }

    public function store(array $data)
    {
        return $this->model()::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model()::where([
            'id' => $id
        ])->
            update(
                $data
            );
    }

    public function destroy(int $id)
    {
        return $this->model()::where([
            'id' => $id
        ])->delete();
    }
}