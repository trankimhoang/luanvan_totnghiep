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
        Schema::create('product_attr_config', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->comment('id product trong table product');
            $table->unsignedBigInteger('attribute_id')->comment('id attribute trong table attribute');
            $table->boolean('is_private')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attr_config');
    }
};
