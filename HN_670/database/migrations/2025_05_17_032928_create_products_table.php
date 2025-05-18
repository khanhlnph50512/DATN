<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('price_sale', 12, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->integer('quantity')->default(0);
            $table->string('sizes')->nullable(); // lưu chuỗi size: "S,M,L" hoặc json
            $table->string('colors')->nullable(); // lưu chuỗi màu: "Đỏ,Xanh,Trắng"
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
