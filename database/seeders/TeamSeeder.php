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
        Team::create(['name' => 'Khu quản lý giáo dục học viên số 1']);
        Team::create(['name' => 'Khu quản lý giáo dục học viên số 2']);
        Team::create(['name' => 'Khu quản lý giáo dục học viên số 3']);
        Team::create(['name' => 'Khu quản lý giáo dục học viên số 4']);
        Team::create(['name' => 'Khu quản lý giáo dục học viên số 5']);
        Team::create(['name' => 'Khu quản lý giáo dục học viên tự nguyện']);

        Team::create(['name' => 'Phòng tổ chức hành chính']);
        Team::create(['name' => 'Phòng giáo dục tư vấn']);
        Team::create(['name' => 'Phòng kế hoạch tài chính']);
        Team::create(['name' => 'Phòng An ninh trật tự']);
    }
}
