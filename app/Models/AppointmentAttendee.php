<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentAttendee extends Model
{
    use HasFactory;

    protected $table = 'appointment_attendee';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone_number',
        'appointment_id',
    ];

    public function Appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
