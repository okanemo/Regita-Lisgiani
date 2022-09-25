<?php
namespace Database\Seeders;

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
        $data = array(
            array(
                'role_id' => 1,
                'fullname' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('admin123'),
                'status' => 'active'
               ),
            array(
                'role_id' => 2,
                'fullname' => 'superadmin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('superadmin123'),
                'status' => 'active'
               ),
            );
        \App\Models\Admin\UsersModel::insert($data);
    }
}
