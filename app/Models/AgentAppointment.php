<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentAppointment extends Model
{
    use HasFactory;

    protected $table = 'agent_appointment';
    protected $fillable = [
        'agent_id',
        'appointment_id',
    ];
    
}
