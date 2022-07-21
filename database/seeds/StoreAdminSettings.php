<?php

use Illuminate\Database\Seeder;

class StoreAdminSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \DB::table('settings')->where('id', '=', 23)->delete();

        \DB::table('settings')->insert(array (
            0 =>
                array (
                    'id' => 23,
                    'key'=> 'StoreAdminSubscriptionEndRedirect',
                    'value' => '0',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

        ));
    }
}
