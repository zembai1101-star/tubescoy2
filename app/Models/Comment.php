<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // Mengizinkan pengisian massal kolom-kolom ini ke database
    protected $fillable = ['post_id', 'user_id', 'comment', 'name', 'email'];

    /**
     * Relasi ke model Post (Satu komentar terikat pada satu artikel)
     * INI KUNCI SAKTI YANG TADI HILANG DAN BIKIN EROR CUY!
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Relasi ke model User (Satu komentar ditulis oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}