<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('user_coupons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'coupon_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_coupons');
    }
}
