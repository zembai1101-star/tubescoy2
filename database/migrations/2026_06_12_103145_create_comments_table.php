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
    Schema::table('comments', function (Blueprint $table) {
        // Menambahkan kolom body jika memang belum ada di database
        if (!Schema::hasColumn('comments', 'body')) {
            $table->text('body')->after('user_id');
        }
    });
}
};