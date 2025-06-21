<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('product_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'coupon_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_coupons');
    }
}
