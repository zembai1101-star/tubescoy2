@extends('layouts.app')

@section('content')
    <div class="content-header pt-3 px-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-edit mr-2"></i>Edit Artikel</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Perubahan Artikel</h3>
                        </div>

                        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-body">
                                
                                <div class="form-group">
                                    <label>Judul Artikel</label>
                                    <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="category_id" class="font-weight-bold">Kategori Artikel</label>
                                    <select name="category_id" id="category_id" class="form-control select2-single" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tags" class="font-weight-bold">Tags Artikel</label>
                                    <select name="tags[]" id="tags" class="form-control select2" multiple="multiple" style="width: 100%;" data-placeholder="Pilih Tag">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Foto Saat Ini:</label><br>
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" class="img-thumbnail mb-2" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <p class="text-muted"><i class="fas fa-image mr-1"></i> Tidak ada foto lama.</p>
                                    @endif
                                    
                                    <label class="d-block">Ganti Foto Baru (Kosongkan jika tidak ingin diubah):</label>
                                    <input type="file" name="image" class="form-control-file" accept="image/*">
                                </div>

                                <div class="form-group">
                                    <label>Status Penerbitan</label>
                                    <select name="status" class="form-control" required>
                                        <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Publish</option>
                                        <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Konten</label>
                                    <textarea name="content" id="editor" class="form-control" rows="5">{{ $post->content }}</textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Mengaktifkan efek popup multi-select pada tag
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: " Klik untuk menambah atau hapus tag...",
                allowClear: true
            });

            // Mengaktifkan select2 juga untuk pilihan kategori tunggal
            $('.select2-single').select2({
                theme: 'bootstrap4',
                placeholder: "-- Pilih Kategori --",
                allowClear: true
            });
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Mengaktifkan efek popup pencarian pada class .select2 (Tags)
        $('.select2').select2({
            theme: 'bootstrap4',
            placeholder: " Klik dan pilih tag...",
            allowClear: true
        });
    });
</script>
@endsection