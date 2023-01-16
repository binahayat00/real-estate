<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\AddZipcodeToAppointmentsRequest;
use App\Http\Requests\Appointment\AssignAgentToAppointmentRequest;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Models\Appointment;
use App\Repositories\AgentAppointmentRepository;
use App\Repositories\AppointmentAttendeeRepository;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $appointmentRepository;
    public $agentAppointmentRepository;
    public $appointmentAttendeeRepository;
    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
        $this->agentAppointmentRepository = new AgentAppointmentRepository();
        $this->appointmentAttendeeRepository = new AppointmentAttendeeRepository();
    }
    public function index()
    {
        return $this->appointmentRepository->all();
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $appointment = $this->appointmentRepository->store($data);
        return $this->appointmentAttendeeRepository->store([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'appointment_id' => $appointment->id
        ]);
    }

    public function update(Appointment $appointment, UpdateRequest $updateRequest)
    {
        return $this->appointmentRepository->update($appointment->id, $updateRequest->validated());
    }

    public function destroy(Appointment $appointment)
    {
        return $this->appointmentRepository->destroy($appointment->id);
    }

    public function addZipcodeToAppointments(AddZipcodeToAppointmentsRequest $request)
    {
        $data = $request->validated();
        foreach ($data['appointmentIds'] as $appointmentId) {
            $result[] = $this->appointmentRepository->update($appointmentId, ['zipcode' => $data['zipcode']]);
        }
        return $result;
    }

    public function assignAgentToAppointment(AssignAgentToAppointmentRequest $request)
    {
        return $this->agentAppointmentRepository->assignAgentToAppointment($request->validated());
    }
}