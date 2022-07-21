<?php

use Illuminate\Database\Seeder;

class PaypalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->where('id', '=', 19)->delete();
        \DB::table('settings')->where('id', '=', 20)->delete();
        \DB::table('settings')->where('id', '=', 21)->delete();
        \DB::table('settings')->where('id', '=', 22)->delete();

        \DB::table('settings')->insert(array (
            0 =>
                array (
                    'id' => 19,
                    'key'=> 'IsPaypalPaymentEnabled',
                    'value' => '1',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

            1 =>
                array (
                    'id' => 20,
                    'key'=> 'PaypalMode',
                    'value' => 'sandbox',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),
            2 =>
                array (
                    'id' => 21,
                    'key'=> 'PaypalKeyId',
                    'value' => 'ATdi05eky96suWs5N89MQJRe_2zLXbD23bqe8nRW9CHp2vsgjKOZyRMnX2GEchcW1kintCP3qcZlT1Kg',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),
            3 =>
                array (
                    'id' => 22,
                    'key'=> 'PaypalKeySecret',
                    'value' => 'EELzZmGlv2l8veRcQCDac59uRI8xhGjeKfXgjY_URpt0HaoEjHmjAceUxMO83F8M5MSu-D4DqZrTmF9X',
                    'created_at' => '2019-09-06 21:52:30',
                    'updated_at' => '2019-09-06 21:52:30',
                ),

        ));
    }
}
