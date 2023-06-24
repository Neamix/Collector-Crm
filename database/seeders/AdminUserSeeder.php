<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'id' => 1
        ],[
            'id'   => 1,
            'name' => 'System Admin',
            'password' => password_hash('password',PASSWORD_BCRYPT),
            'email' => 'admin@collector.com',
            'type'  => 1
        ]);
    }
}
