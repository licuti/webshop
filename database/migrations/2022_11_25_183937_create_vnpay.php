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
        Schema::create('vnpay', function (Blueprint $table) {
            $table->increments('id_vnp');
            $table->integer('id_user');
            $table->integer('id_bill');
            $table->string('amount_vnp');
            $table->string('bankcode_vnp');
            $table->string('banktranno_vnp');
            $table->string('cardtype_vnp');
            $table->string('paydate_vnp');
            $table->string('transaction_vnp');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vnpay');
    }
};
