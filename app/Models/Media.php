<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk membuka semua kunci kolom agar bisa diisi data
    protected $guarded = [];
}