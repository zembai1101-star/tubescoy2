<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi (mass assignment)
   protected $fillable = ['title', 'slug', 'content', 'status', 'category_id', 'image'];
    // 1. Relasi: Sebuah artikel memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 2. Relasi Many-to-Many ke Tag (menggunakan tabel categories)
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'post_tag', 'post_id', 'category_id');
    }

    // 3. TAMBAHKAN INI: Relasi One-to-Many ke Comment (Agar fitur Komentar tidak Error)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}