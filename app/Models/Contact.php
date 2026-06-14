<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // 1. Tentukan nama tabelnya (opsional, tapi aman biar Laravel gak bingung)
    protected $table = 'contacts';

    // 2. Daftarkan kolom yang boleh diisi lewat form (Penyelamat MassAssignment)
    protected $fillable = [
        'name', 
        'email', 
        'subject', 
        'message', 
        'is_read'
    ];
}