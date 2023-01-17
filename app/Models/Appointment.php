<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'zipcode',
        'date',
        'distance_from_realestate',
        'arriving_estimated_time',
        'returning_estimated_time',
    ];

    public function appointmentAttendee()
    {
        return $this->hasMany(AppointmentAttendee::class);
    }
}
