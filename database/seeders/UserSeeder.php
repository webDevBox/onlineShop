<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'name' => 'Haroon',
                'email' => 'admin',
                'password' => bcrypt('admin'),
                'userRole' => 1,
                'status'  => 0
            ]
        );
    }
}
