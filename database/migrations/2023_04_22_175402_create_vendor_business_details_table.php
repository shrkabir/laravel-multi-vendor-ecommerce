<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_business_details', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('shop_name');
            $table->text('shop_address');
            $table->integer('shop_country_id');
            $table->integer('shop_state_id');
            $table->integer('shop_city_id');
            $table->string('shop_pincode');
            $table->string('shop_phone');
            $table->text('shop_website');
            $table->string('shop_email')->unique();
            $table->string('shop_licence_number')->unique();
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
        Schema::dropIfExists('vendor_business_details');
    }
};
