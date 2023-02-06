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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id_product');
            $table->integer('id_category');
            $table->string('name_product', 150);
            $table->text('describe_product');
            $table->text('detail_product');
            $table->string('image_product');
            $table->string('price_product');
            $table->string('discount_product')->nullable();
            $table->string('evaluate_product')->nullable();
            $table->integer('sales_product')->nullable();
            $table->string('slug_product');
            $table->string('keywords_product')->nullable();
            $table->string('status_product');
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
        Schema::dropIfExists('product');
    }
};
