@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-tags mr-2"></i>Kategori & Tag</h1>
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
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Kelola Kategori</h3>
                        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalTambah" onclick="$('#input_type').val('category'); $('.modal-title-text').text('Kategori')">
                            <i class="fas fa-plus mr-1"></i> Tambah Kategori
                        </button>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Slug</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $cat)
                                <tr>
                                    <td><strong>{{ $cat->name }}</strong></td>
                                    <td><span class="badge badge-light text-primary">/category/{{ $cat->slug }}</span></td>
                                    <td>
                                        <button class="btn btn-xs btn-info mr-1" data-toggle="modal" data-target="#modalEdit{{ $cat->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center text-muted py-4">Belum ada kategori.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-teal card-outline">
                    <div class="card-header">
                        <h3 class="card-title mt-1">Kelola Tag</h3>
                        <button class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#modalTambah" onclick="$('#input_type').val('tag'); $('.modal-title-text').text('Tag')">
                            <i class="fas fa-plus mr-1"></i> Tambah Tag
                        </button>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Nama Tag</th>
                                    <th>Slug</th>
                                    <th style="width: 120px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tags as $tag)
                                <tr>
                                    <td><strong>#{{ $tag->name }}</strong></td>
                                    <td><span class="badge badge-light text-success">/tag/{{ $tag->slug }}</span></td>
                                    <td>
                                        <button class="btn btn-xs btn-info mr-1" data-toggle="modal" data-target="#modalEdit{{ $tag->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <form action="{{ route('categories.destroy', $tag->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus tag ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center text-muted py-4">Belum ada tag.</td></tr>
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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="fas fa-tags mr-2"></i>Tambah <span class="modal-title-text"></span> Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" id="input_type" value="category">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama / Judul</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Aneh / Unik" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($categories as $cat)
<div class="modal fade" id="modalEdit{{ $cat->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Kategori</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{ route('categories.update', $cat->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" class="form-control" value="{{ $cat->name }}" required>
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

@foreach($tags as $tag)
<div class="modal fade" id="modalEdit{{ $tag->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Tag</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{ route('categories.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Tag</label>
                        <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
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