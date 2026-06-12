<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi: Setiap komentar adalah milik dari satu artikel (Post)
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}