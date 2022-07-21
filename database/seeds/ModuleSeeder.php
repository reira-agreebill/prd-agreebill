<?php

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('modules')->where('id', '=', 1)->delete();


        \DB::table('modules')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name'=> 'Free Template',
                    'description' => 'SaaS Theme',
                    'version' => '1.0',
                    'category' => '1',
                    'module_id' => '1',
                    'is_active' => '0',
                    'is_installed' => '0',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

        ));
    }
}
