<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        // Thay enum cũ bằng enum mới
        DB::statement("ALTER TABLE orders MODIFY status ENUM(
            'pending',
            'processing',
            'shipping',
            'delivered',
            'cancelled',
            'refunded'
        ) DEFAULT 'pending'");
    }

    public function down()
    {
        // Quay về enum cũ nếu rollback
        DB::statement("ALTER TABLE orders MODIFY status ENUM(
            'pending',
            'processing',
            'shipping',
            'delivered'
        ) DEFAULT 'pending'");
    }
};
