@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-images mr-2"></i>Galeri Media</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn btn-primary float-sm-right mt-2 mt-sm-0" data-toggle="modal" data-target="#modalUpload">
                    <i class="fas fa-cloud-upload-alt mr-1"></i> Unggah Gambar Baru
                </button>
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
            @forelse($gallery as $item)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 position-relative">
                        <div style="height: 180px; overflow: hidden; background: #e9ecef; border-radius: 4px 4px 0 0;">
                            <img src="{{ $item->filepath }}" alt="{{ $item->original_name }}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <div class="card-body p-2 bg-white">
                            <p class="text-truncate mb-1 small text-dark font-weight-bold" title="{{ $item->original_name }}">
                                {{ $item->original_name }}
                            </p>
                            <p class="text-muted mb-0" style="font-size: 11px;">
                                {{ round($item->filesize / 1024, 1) }} KB
                            </p>
                        </div>
                        <div class="card-footer p-2 bg-light d-flex justify-content-between align-items-center">
                            <button class="btn btn-xs btn-outline-secondary" onclick="copyToClipboard('{{ url($item->filepath) }}')" title="Salin URL Gambar">
                                <i class="fas fa-copy mr-1"></i> Copy URL
                            </button>
                            
                            <form action="{{ route('media.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen foto ini dari server?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger" title="Hapus Gambar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 py-5 text-center text-muted">
                    <i class="fas fa-images fa-3x mb-3 d-block"></i>
                    Belum ada gambar yang diunggah ke galeri media.
                </div>
            @endforelse
        </div>

    </div>
</div>

<div class="modal fade" id="modalUpload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-upload mr-2"></i>Upload File Gambar</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih File Gambar</label>
                        <input type="file" name="image" class="form-control-file border p-2 w-100 rounded" required>
                        <small class="text-muted d-block mt-1">Format: JPG, JPEG, PNG, WEBP, GIF (Maks. 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt mr-1"></i> Mulai Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        alert('URL Gambar berhasil disalin ke clipboard!');
    }, function(err) {
        alert('Gagal menyalin URL: ', err);
    });
}
</script>
@endsection