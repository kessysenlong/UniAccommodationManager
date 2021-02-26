<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
           ['name' => 'Admin User',
            'email' => 'admin@baze.com',
            'student_id' => null,
            'is_admin' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ],
        ['name' => 'Student User',
            'email' => 'student@baze.com',
            'student_id' => 'BU/21A/300/IT',
            'is_admin' => false,
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
            ]
        ]
    );
    }
}
