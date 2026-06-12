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
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        // Hubungkan ke id postingan/artikel (sesuaikan 'post_id' jika nama tabel artikelmu berbeda)
        $table->foreignId('post_id')->constrained()->onDelete('cascade'); 
        $table->string('name');         // Nama komentator
        $table->string('email');        // Email komentator
        $table->text('comment');        // Isi teks komentar
        $table->timestamps();
    });
}
};
