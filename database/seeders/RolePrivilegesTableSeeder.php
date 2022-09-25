<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolePrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 7; $i++) {
            $array['role_id'] = 1;
            $array['menu_id'] = $i;
            $array['view'] = '1';
            $array['create'] = '1';
            $array['edit'] = '1';
            $array['delete'] = '1';
            $data[] = $array;
        }
        \App\Models\Admin\RolePrivilegesModel::insert($data);
    }
}
