<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'status', 'category_id']; // <-- Tambahkan category_id

    // Relasi balik: Sebuah artikel memiliki satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    // Relasi Many-to-Many ke Tag (menggunakan tabel categories)
    public function tags()
    {
        return $this->belongsToMany(Category::class, 'post_tag', 'post_id', 'category_id');
    }
}