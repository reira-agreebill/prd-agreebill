<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('IsCodEnabled')->default(1);
            $table->bigInteger('IsPaypalEnabled')->default(1);
            $table->bigInteger('IsStripeEnabled')->default(1);
            $table->bigInteger('IsRazorpayEnabled')->default(1);
            $table->string('StoreCurrency')->nullable();
            $table->longText('StripePublishableKey')->nullable();
            $table->longText('StripeSecretKey')->nullable();
            $table->longText('RazorpayKeyId')->nullable();
            $table->longText('RazorpayKeySecret')->nullable();
            $table->longText('PaypalMode')->nullable();
            $table->longText('PaypalKeyId')->nullable();
            $table->longText('PaypalKeySecret')->nullable();
            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_settings');
    }
}
