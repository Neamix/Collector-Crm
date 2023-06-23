<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::updateOrCreate(
        [
            'id' => 1
        ],
        [
            'id' => 1,
            'option' => 'system_type',
            'value'  => 'course_managment_system'
        ]);
    }
}
