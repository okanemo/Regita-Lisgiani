<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
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
                'menu_name' => 'Dashboard',
                'menu_url' => 'dashboard'
               ),
            array(
                'menu_name' => 'Manage Users',
                'menu_url' => 'user'
               ),
            array(
                'menu_name' => 'Daily Planning',
                'menu_url' => 'planning-daily'
                ),
            array(
                'menu_name' => 'Monthly Planning',
                'menu_url' => 'planning-monthly'
                ),
            array(
                'menu_name' => 'Production Result',
                'menu_url' => 'production-result'
                ),
            array(
                'menu_name' => 'Maintenance',
                'menu_url' => 'maitenance'
                )
            );
        \App\Models\Admin\MenuModel::insert($data);
    }
}
