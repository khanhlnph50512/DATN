<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->tinyInteger('status')->default(1); // 1 = hiện, 0 = ẩn
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }
};
