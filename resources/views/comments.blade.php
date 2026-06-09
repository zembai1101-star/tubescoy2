@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0"><i class="fas fa-comments mr-2"></i>Moderasi Komentar</h1>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Komentar Masuk</h3>
            </div>
            <div class="card-body">
                <div class="post">
                    <div class="user-block">
                        <span class="username" style="margin-left:0;"><a href="#">Budi Santoso</a></span>
                        <span class="description" style="margin-left:0;">Pada artikel: <em>"Belajar Laravel untuk Pemula"</em> - Hari ini 14:20</span>
                    </div>
                    <p>Wah artikelnya sangat membantu gan! Ditunggu kelanjutannya.</p>
                    <p>
                        <a href="#" class="link-black text-sm mr-2 text-success"><i class="fas fa-check mr-1"></i> Setujui</a>
                        <a href="#" class="link-black text-sm text-danger"><i class="fas fa-trash mr-1"></i> Hapus</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection