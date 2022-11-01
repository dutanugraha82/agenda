<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@ptk.ubpkarawang.ac.id',
                'password' => 'bismilah',
                'role' => 'super_admin',
                'unit_id' =>null
            ],
            [
                'name' => 'Admin Univ',
                'email' => 'adminuniv@ptk.ubpkarawang.ac.id',
                'password' => 'hamdalah',
                'role' => 'admin_univ',
                'unit_id' =>null
            ],
            [
                'name' => 'Admin Unit',
                'email' => 'adminunit@ptk.ubpkarawang.ac.id',
            'password' => 'istighfar',
                'role' => 'admin_unit',
                'unit_id' => null
            ]
            ];

            foreach($users as $item){
                User::create([
                    'name' => $item['name'],
                    'email' => $item['email'],
                    'password' => $item['password'],
                    'role' => $item['role'],
                    'unit_id' => $item['unit_id'],
                ]);

            }

    }
}
