<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::create([
            'user_id' => 2
        ]);

        Agent::create([
            'user_id' => 3
        ]);

        Agent::create([
            'user_id' => 4
        ]);
    }
}
