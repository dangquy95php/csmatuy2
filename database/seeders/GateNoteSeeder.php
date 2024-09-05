<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GateNote;

class GateNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GateNote::create(['name' => 'vào làm']);
        GateNote::create(['name' => 'đi phép']);
        GateNote::create(['name' => 'phép vào']);
        GateNote::create(['name' => 'ra ca']);
        GateNote::create(['name' => 'hái cà phê A7']);
        GateNote::create(['name' => 'hái cà phê A8']);
        GateNote::create(['name' => 'đi mua đồ']);
        GateNote::create(['name' => 'làm cà tím']);
        GateNote::create(['name' => 'khác']);
    }
}
