@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0"><i class="fas fa-file-signature mr-2"></i>Draft Konten</h1>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card card-warning card-outline">
            <div class="card-header">
                <h3 class="card-title">Artikel yang Belum Diterbitkan</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul Draft</th>
                            <th>Tanggal Dibuat</th>
                            <th>Penulis</th>
                            <th style="width: 150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><em>Belum ada draft artikel saat ini.</em></td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection