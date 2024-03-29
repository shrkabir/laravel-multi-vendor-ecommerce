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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('type')->comment('1=super admin, 2=admin, 3=subadmin, 4=vendor');
            $table->tinyInteger('vendor_id')->nullable();
            $table->string('mobile');
            $table->string('email')->unique();
            $table->text('password');
            $table->text('photo')->nullable();
            $table->tinyInteger('status')->comment('0= Inactive, 1= Active');
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
        Schema::dropIfExists('admins');
    }
};
