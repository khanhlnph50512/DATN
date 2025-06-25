<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->decimal('minimum_order_amount', 10, 2)->nullable();
            $table->date('valid_from');
            $table->date('valid_until');
            $table->integer('usage_limit')->nullable(); // số lần được dùng tối đa
            $table->boolean('active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
