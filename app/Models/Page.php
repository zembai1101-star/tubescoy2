<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // WAJIB TAMBAHKAN INI AGAR CONTROLLER BISA MENYIMPAN DATA
    protected $fillable = ['title', 'slug', 'content'];
}