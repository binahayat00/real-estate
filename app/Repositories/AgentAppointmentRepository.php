<?php

namespace App\Repositories;

use App\Models\AgentAppointment;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class AgentAppointmentRepository.
 */
class AgentAppointmentRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return AgentAppointment::class;
    }

    public function assignAgentToAppointment(array $data)
    {
        return $this->model()::create([
            'agent_id' => $data['agent_id'],
            'appointment_id' => $data['appointment_id'],
        ]);
    }
}
