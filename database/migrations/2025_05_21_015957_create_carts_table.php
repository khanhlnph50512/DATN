<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable()->index();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_id')->nullable()->constrained('product_variations')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();

            // Giới hạn chỉ 1 record cho cùng user/session với product + variation
            $table->unique(['user_id', 'session_id', 'product_id', 'variation_id'], 'cart_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
