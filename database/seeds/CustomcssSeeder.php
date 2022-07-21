<?php

use Illuminate\Database\Seeder;

class CustomcssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->where('id', '=', 18)->delete();

        \DB::table('settings')->insert(array (
            0 =>
                array (
                    'id' => 18,
                    'key'=> 'CustomCss',
                    'value' => '',
                    'created_at' => '2020-09-06 21:52:30',
                    'updated_at' => '2020-09-06 21:52:30',
                ),


        ));
    }
}
