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
        Team::create(['name' => 'Khu 1', 'note' => 'Khu QL-GDHV số 1']);
        Team::create(['name' => 'Khu 2', 'note' => 'Khu QL-GDHV số 2']);
        Team::create(['name' => 'Khu 3', 'note' => 'Khu QL-GDHV số 3']);
        Team::create(['name' => 'Khu 4', 'note' => 'Khu QL-GDHV số 4']);
        Team::create(['name' => 'Khu 5', 'note' => 'Khu QL-GDHV số 5']);
        Team::create(['name' => 'Khu SX-DV-ĐS', 'note' => 'Khu SX-DV-ĐS']);
        Team::create(['name' => 'Khu Tự Nguyện', 'note' => 'Khu QL-GDHV Tự nguyện']);

        

        Team::create(['name' => 'Ban Giám Đốc', 'note' => 'Ban Giám đốc']);
        Team::create(['name' => 'Phòng TC-HC', 'note' => 'Phòng Tổ chức - Hành chính', 'type' => 2]);
        Team::create(['name' => 'Phòng GD-TV', 'note' => 'Phòng Giáo dục - Tư vấn', 'type' => 2]);
        Team::create(['name' => 'Phòng KH-TC', 'note' => 'Phòng Kế hoạch - Tài chính', 'type' => 2]);
        Team::create(['name' => 'Phòng ANTT', 'note' => 'Phòng ANTT - QLHV']);
        Team::create(['name' => 'Phòng Y-Te', 'note' => 'Phòng Y tế', 'type' => 2]);
    }
}