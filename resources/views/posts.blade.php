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
                                <th style="width: 70px; text-align: center;">Preview</th>
                                <th>Judul Artikel</th>
                                <th>Kategori</th>
                                <th>Tags</th>
                                <th>Slug / URL</th>
                                <th>Status</th>
                                <th>Tanggal Pembuatan</th>
                                <th style="width: 130px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($posts as $post)
                                <tr>
                                    <td class="text-center" style="vertical-align: middle;">
                                        @if($post->image)
                                            <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail"
                                                style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px; border: 1px solid #dee2e6; margin: 0 auto;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td style="vertical-align: middle;"><strong>{{ $post->title }}</strong></td>

                                    <td style="vertical-align: middle;">
                                        @if($post->category)
                                            <span class="badge badge-primary">{{ $post->category->name }}</span>
                                        @else
                                            <span class="text-muted small">Tanpa Kategori</span>
                                        @endif
                                    </td>

                                    <td style="vertical-align: middle;">
                                        @forelse($post->tags as $tag)
                                            <span class="badge badge-info">#{{ $tag->name }}</span>
                                        @empty
                                            <span class="text-muted small">-</span>
                                        @endforelse
                                    </td>

                                    <td style="vertical-align: middle;"><small
                                            class="text-muted">/posts/{{ $post->slug }}</small></td>

                                    <td style="vertical-align: middle;">
                                        <span class="badge badge-{{ $post->status == 'publish' ? 'success' : 'warning' }}">
                                            {{ ucfirst($post->status) }}
                                        </span>
                                    </td>

                                    <td style="vertical-align: middle;">{{ $post->created_at->format('d Jun Y') }}</td>

                                    <td style="vertical-align: middle; text-align: center;">
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info"
                                            title="Edit Artikel">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Artikel">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">Belum ada artikel yang ditulis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection