@extends('layouts.app')

@section('content')
    <div class="content-header pt-3 px-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-file-alt mr-2"></i>Halaman Statis</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-check mr-2"></i>{{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title mt-1">Kelola Halaman Utama Blog</h3>
                            <button class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                data-target="#modalTambah">
                                <i class="fas fa-plus-circle mr-1"></i> Tambah Halaman
                            </button>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap align-middle">
                                <thead>
                                    <tr>
                                        <th>Judul Halaman</th>
                                        <th>Slug / URL Halaman</th>
                                        <th>Tanggal Diperbarui</th>
                                        <th style="width: 150px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pages as $page)
                                        <tr>
                                            <td><strong>{{ $page->title }}</strong></td>
                                            <td><span class="badge badge-light text-danger">/{{ $page->slug }}</span></td>
                                            <td>{{ $page->updated_at->format('d M Y H:i') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-info mr-1" data-toggle="modal"
                                                    data-target="#modalEdit{{ $page->id }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>

                                                <form action="{{ route('pages.destroy', $page->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-xs btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-5">
                                                <i class="fas fa-folder-open fa-2x d-block mb-2"></i> Belum ada data halaman statis.
                                            </td>
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

    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-plus mr-2"></i>Tambah Halaman Baru</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('pages.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul Halaman</label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Tentang Kami"
                                required>
                        </div>
                        <div class="form-group">
                            <label>Konten Halaman</label>
                            <textarea name="content" class="form-control" rows="8" placeholder="Tulis isi konten halaman di sini..."
                                required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($pages as $page)
        <div class="modal fade" id="modalEdit{{ $page->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Halaman</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <form action="{{ route('pages.update', $page->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Judul Halaman</label>
                                <input type="text" name="title" class="form-control" value="{{ $page->title }}" required>
                            </div>
                            <div class="form-group">
                                <label>Konten Halaman</label>
                                <textarea name="content" class="form-control" rows="8" required>{{ $page->content }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-info"><i class="fas fa-save mr-1"></i>Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach    
@endsection