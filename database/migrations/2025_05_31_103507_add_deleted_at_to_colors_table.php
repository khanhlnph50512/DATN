<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('colors', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->softDeletes(); // thêm cột deleted_at
        });
    }

    public function down()
    {
        Schema::table('colors', function (Illuminate\Database\Schema\Blueprint $table) {
            $table->dropSoftDeletes(); // xóa cột nếu rollback
        });
    }
};
