@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-newspaper mr-2"></i>Semua Artikel</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('posts.create') }}" class="btn btn-primary float-sm-right mt-2 mt-sm-0">
                    <i class="fas fa-plus mr-1"></i> Tulis Artikel Baru
                </a>
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

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title mt-1">Daftar Artikel Utama (Published)</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th>Judul Artikel</th>
                            <th>Kategori</th>
                            <th>Tags</th>
                            <th>Slug / URL</th>
                            <th>Status</th>
                            <th>Tanggal Pembuatan</th>
                            <th style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td><strong>{{ $post->title }}</strong></td>
                            
                            <td>
                                @if($post->category)
                                    <span class="badge badge-primary px-2 py-1">{{ $post->category->name }}</span>
                                @else
                                    <span class="text-muted small"><em>Tanpa Kategori</em></span>
                                @endif
                            </td>

                            <td>
                                @forelse($post->tags as $tag)
                                    <span class="badge badge-info px-2 py-1 mr-1">#{{ $tag->name }}</span>
                                @empty
                                    <span class="text-muted small"><em>-</em></span>
                                @endforelse
                            </td>

                            <td><span class="badge badge-light text-muted">/posts/{{ $post->slug }}</span></td>
                            <td>
                                <span class="badge {{ $post->status == 'publish' ? 'badge-success' : 'badge-warning' }} px-2 py-1">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </td>
                            <td>{{ $post->created_at->format('d M Y') }}</td>
                            <td>
                                @if($post->status == 'draft')
                                <form action="{{ route('posts.publish', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Terbitkan artikel draft ini sekarang?')">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn btn-xs btn-success mr-1" title="Publish Sekarang">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </form>
                                @endif

                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-xs btn-info mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                                Belum ada artikel yang diterbitkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection