<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
    $table->id();
    $table->string('seri_customer')->unique(); // Mã người dùng riêng
    $table->string('name');
    $table->string('email');
    $table->string('phone')->nullable();
    $table->string('address'); // ✅ Địa chỉ nhận hàng
    $table->timestamps();
    $table->softDeletes();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
