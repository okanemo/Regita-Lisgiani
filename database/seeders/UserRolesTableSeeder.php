<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
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
                'role_name' => 'Superadmin'
               ),
            array(
                'role_name' => 'Admin'
               )
            );
        \App\Models\Admin\UserRolesModel::insert($data);
    }
}
