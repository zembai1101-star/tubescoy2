@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-comments mr-2"></i>Interaksi Komentar</h1>
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
                        <h3 class="card-title mt-1">Semua Komentar Pengunjung</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap align-middle">
                            <thead>
                                <tr>
                                    <th>Komentator</th>
                                    <th>Isi Komentar</th>
                                    <th>Di Artikel</th>
                                    <th>Tanggal</th>
                                    <th style="width: 100px; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($comments as $comment)
                                    <tr>
                                        <td>
                                            <strong>{{ $comment->name }}</strong>
                                            <small class="text-muted d-block">{{ $comment->email }}</small>
                                        </td>
                                        <td style="white-space: normal; max-width: 300px;">
                                            {{ $comment->comment }}
                                        </td>
                                        <td style="white-space: normal; max-width: 200px;">
                                            <span class="badge badge-secondary">
                                                {{ $comment->post->title ?? 'Artikel Dihapus' }}
                                            </span>
                                        </td>
                                        <td>{{ $comment->created_at->format('d M Y H:i') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus Komentar">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">
                                            <i class="fas fa-comment-slash fa-2x d-block mb-2"></i> Belum ada komentar masuk dari pengunjung.
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
@endsection