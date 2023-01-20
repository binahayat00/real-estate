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
use App\Services\MapService;
use App\Services\PostCodeService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    protected $appointmentRepository;
    protected $agentAppointmentRepository;
    protected $appointmentAttendeeRepository;
    protected $postCodeService;
    protected $mapService;
    public function __construct()
    {
        $this->appointmentRepository = new AppointmentRepository();
        $this->agentAppointmentRepository = new AgentAppointmentRepository();
        $this->appointmentAttendeeRepository = new AppointmentAttendeeRepository();
        $this->postCodeService = new PostCodeService();
        $this->mapService = new MapService();
        $this->middleware('auth:api');
    }
    public function index()
    {
        return response()->json($this->appointmentRepository->all(), 200);
    }

    public function show(Appointment $appointment)
    {
        return response()->json($this->appointmentRepository->show($appointment->id));
    }
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $isValidatePostCode = ($data['zipcode'] ?? false) ? $this->postCodeService->validatePostCode($data['zipcode']) : ['result' => true];
        if ($isValidatePostCode['result'] == false)
            return response()->json(['message' => ['0' => [$isValidatePostCode['message']]]], 400);

        $mapsData = ($data['zipcode'] ?? false) ? $this->mapService->calculateDistancesForAppointmentTable($data['zipcode']) : $data;
        $data = array_merge($data, $mapsData);

        $appointment = $this->appointmentRepository->store($data);
        (isset($data['name']) || isset($data['surname']) || isset($data['email']) || isset($data['phone_number'])) ? $this->appointmentAttendeeRepository->store([
            'name' => $data['name'] ?? '',
            'surname' => $data['surname'] ?? '',
            'email' => $data['email'] ?? '',
            'phone_number' => $data['phone_number'] ?? '',
            'appointment_id' => $appointment->id
        ]) : null;
        return response()->json($appointment, 200);
    }

    public function update(Appointment $appointment, UpdateRequest $updateRequest)
    {
        $data = $updateRequest->validated();
        $isValidatePostCode = ($data['zipcode'] ?? false) ? $this->postCodeService->validatePostCode($data['zipcode']) : ['result' => true];
        if ($isValidatePostCode['result'] == false)
            return response()->json(['message' => ['0' => [$isValidatePostCode['message']]]], 400);

        $mapsData = ($data['zipcode'] ?? false) ? $this->mapService->calculateDistancesForAppointmentTable($data['zipcode']) : $data;
        $data = array_merge($data, $mapsData);

        return response()->json($this->appointmentRepository->update($appointment->id, $data), 200);
    }

    public function destroy(Appointment $appointment)
    {
        return response()->json($this->appointmentRepository->destroy($appointment->id), 200);
    }

    public function addZipcodeToAppointments(AddZipcodeToAppointmentsRequest $request)
    {
        $data = $request->validated();
        $isValidatePostCode = ($data['zipcode'] ?? false) ? $this->postCodeService->validatePostCode($data['zipcode']) : ['result' => true];
        if ($isValidatePostCode['result'] == false)
            return response()->json(['message' => ['0' => [$isValidatePostCode['message']]]], 400);

        foreach ($data['appointmentIds'] as $appointmentId) {
            $result[] = $this->appointmentRepository->update($appointmentId, ['zipcode' => $data['zipcode']]);
        }
        return response()->json($result, 200);
    }

    public function assignAgentToAppointment(AssignAgentToAppointmentRequest $request)
    {
        return response()->json($this->agentAppointmentRepository->assignAgentToAppointment($request->validated()), 200);
    }
}