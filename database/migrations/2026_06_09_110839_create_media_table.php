<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename');  // Nama file acak yang disimpan di sistem
            $table->string('original_name'); // Nama asli file waktu diupload
            $table->string('filepath');  // Jalur lokasi file gambar
            $table->string('filetype');  // Jenis file (image/jpeg, image/png, dll)
            $table->bigInteger('filesize'); // Ukuran file gambar (bytes)
            $table->timestamps();
        });
    }
};
