<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\StoreRequest;
use App\Http\Requests\Appointment\UpdateRequest;
use App\Models\Appointment;
use App\Repositories\AppointmentRepository;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public $appointmentRepository;
    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }
    public function index()
    {
        return $this->appointmentRepository->all();
    }
    public function store(StoreRequest $request)
    {
        return $this->appointmentRepository->store($request->validated());
    }

    public function update(Appointment $appointment, UpdateRequest $updateRequest)
    {
        return $this->appointmentRepository->update($appointment->id, $updateRequest->validated());
    }

    public function destroy(Appointment $appointment){
        return $this->appointmentRepository->destroy($appointment->id);
    }
}
