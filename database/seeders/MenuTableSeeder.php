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
                'menu_name' => 'Manage Users',
                'menu_url' => 'user'
               ),
            array(
                'menu_name' => 'Expense Categories',
                'menu_url' => 'expance-category'
                ),
            array(
                'menu_name' => 'Expense Subcategories',
                'menu_url' => 'expance-subcategory'
                ),
            array(
                'menu_name' => 'Income Categories',
                'menu_url' => 'income-category'
                ),
            array(
                'menu_name' => 'Income Subcategories',
                'menu_url' => 'income-subcategory'
                )
                ,
            array(
                'menu_name' => 'Income',
                'menu_url' => 'income'
                ),
            array(
                'menu_name' => 'Expenses',
                'menu_url' => 'expance'
                ),
            array(
                'menu_name' => 'Income Report',
                'menu_url' => 'income-report'
                )
                ,
            array(
                'menu_name' => 'Expences Report',
                'menu_url' => 'expance-report'
                )
            );
        \App\Models\Admin\MenuModel::insert($data);
    }
}
