<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(TwilloSeeder::class);
        $this->call(PrivacyPolicySeeder::class);
        $this->call(RazorpaySeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(CustomcssSeeder::class);
        $this->call(PaypalSeeder::class);
        $this->call(StoreAdminSettings::class);

    }
}
