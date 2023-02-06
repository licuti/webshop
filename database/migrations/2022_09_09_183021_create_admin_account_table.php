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
        Schema::create('admin_account', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('admin_username');
            $table->string('admin_password');
            $table->string('admin_avatar')->nullable();
            $table->string('admin_name',50)->nullable();
            $table->string('admin_email',100)->unique();
            $table->string('admin_phone',20)->nullable();
            $table->string('admin_address',100)->nullable();
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
        Schema::dropIfExists('admin_account');
    }
};
