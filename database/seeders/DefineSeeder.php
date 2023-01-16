<?php

namespace Database\Seeders;

use App\Models\Define;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Define::create([
            'name' => 'realtor_zipcode',
            'value' => 'cm27pj',
        ]);

        Define::create([
            'name' => 'appointment_duration_in_minutes',
            'value' => '60',
        ]);
    }
}
