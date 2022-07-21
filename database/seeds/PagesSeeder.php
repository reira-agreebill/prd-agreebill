<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->where('id', '=', 15)->delete();
        \DB::table('settings')->where('id', '=', 16)->delete();
        \DB::table('settings')->where('id', '=', 17)->delete();

        \DB::table('settings')->insert(array (
            0 =>
                array (
                    'id' => 15,
                    'key'=> 'Abouts',
                    'value' => 'sample text',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

            1 =>
                array (
                    'id' => 16,
                    'key'=> 'TermsandCondition',
                    'value' => 'sample text',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),
            2 =>
                array (
                    'id' => 17,
                    'key'=> 'Refund',
                    'value' => 'sample text',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

        ));


    }
}
