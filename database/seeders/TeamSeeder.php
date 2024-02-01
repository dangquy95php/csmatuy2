<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Team::create(['name' => 'Khu 1']);
        Team::create(['name' => 'Khu 2']);
        Team::create(['name' => 'Khu 3']);
        Team::create(['name' => 'Khu 4']);
        Team::create(['name' => 'Khu 5']);
        Team::create(['name' => 'Khu Tự Nguyện']);

        Team::create(['name' => 'Phòng TC-HC']);
        Team::create(['name' => 'Phòng GD-TV']);
        Team::create(['name' => 'Phòng KH-TC']);
        Team::create(['name' => 'Phòng ANTT']);
    }
}
