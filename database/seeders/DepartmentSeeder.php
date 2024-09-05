<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create(['name' => 'tân hà']);
        Department::create(['name' => 'lâm hà']);
        Department::create(['name' => 'lâm đồng']);
        Department::create(['name' => 'khác']);
    }
}
