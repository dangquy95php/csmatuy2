<?php

namespace Database\Seeders;

use Hash;
use Illuminate\Database\Seeder;
use App\Models\Contest;

class ContestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contest::create([
            'name' => 'Thi pháp luật tháng 9', 
            'email' => 'Luật thực hiện dân chủ cơ sở',
            'user_id' => 11
        ]);
        Contest::create([
            'name' => 'Thi pháp luật tháng 10', 
            'email' => 'Luật thực hiện dân chủ cơ sở',
            'user_id' => 15
        ]);
    }
}
