@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-users-cog mr-2"></i>Kelola User / Penulis</h1>
            </div>
        </div>
    </div>
</div>

<div class="content px-3">
    <div class="container-fluid">

        {{-- Notifikasi Sukses / Eror --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="icon fas fa-check mr-2"></i>{{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="icon fas fa-exclamation-triangle mr-2"></i>{{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Daftar Pengguna Aplikasi Web</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 50px; text-align: center;">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role / Hak Akses</th>
                                    <th>Status</th>
                                    <th style="width: 180px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td><strong>{{ $user->name }}</strong></td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role === 'admin' || $user->role === 'Super Admin')
                                                <span class="badge badge-danger">Super Admin</span>
                                            @else
                                                <span class="badge badge-primary">User / Pengunjung</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-success">Aktif</span>
                                        </td>
                                        <td class="text-center">
                                            {{-- Tombol Edit Memicu Modal Pop-up --}}
                                            <button type="button" class="btn btn-sm btn-warning text-white mr-1" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>

                                            {{-- Form Tombol Hapus Akun --}}
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->name }} permanen?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" {{ Auth::id() == $user->id ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    {{-- Jendela Kecil Pop-Up (Modal) Edit Nama Per User --}}
                                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                    <h5 class="modal-title text-white font-weight-bold"><i class="fas fa-user-edit mr-2"></i>Edit Username</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-left">
                                                        <div class="form-group">
                                                            <label>Nama Pengguna Baru</label>
                                                            <input type="text" name="name" class="form-value form-control" value="{{ $user->name }}" required>
                                                        </div>
                                                        <small class="text-muted">Email: {{ $user->email }} (Tidak dapat diubah)</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning text-white">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Tidak ada data pengguna terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection