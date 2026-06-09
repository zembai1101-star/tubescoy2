@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0"><i class="fas fa-users mr-2"></i>Kelola User / Penulis</h1>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary btn-sm"><i class="fas fa-user-plus mr-1"></i> Tambah Penulis</button>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role / Hak Akses</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Andriana Manurung</td>
                            <td>andriana@email.com</td>
                            <td><span class="badge bg-danger">Super Admin</span></td>
                            <td><span class="badge bg-success">Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection