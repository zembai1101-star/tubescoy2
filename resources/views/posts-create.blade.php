@extends('layouts.app')

@section('content')
    <div class="content-header pt-3 px-3">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-pen mr-2"></i>Tulis Artikel Baru</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content px-3">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Formulir Artikel</h3>
                        </div>

                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Judul Artikel</label>
                                    <input type="text" name="title" class="form-control" placeholder="Masukkan judul..." required>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="category_id" class="font-weight-bold">Kategori Artikel</label>
                                    <select name="category_id" id="category_id" class="form-control select2-single" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="tags" class="font-weight-bold">Tags (Bisa Pilih Lebih dari Satu)</label>
                                    <select name="tags[]" id="tags" class="form-control select2" multiple="multiple" data-placeholder="Pilih Tag" style="width: 100%;">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Thumbnail / Foto Artikel</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile" accept="image/*">
                                            <label class="custom-file-label" for="exampleInputFile">Pilih gambar...</label>
                                        </div>
                                    </div>
                                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks: 2MB</small>
                                </div>

                                <div class="form-group">
                                    <label>Status Penerbitan</label>
                                    <select name="status" class="form-control" required>
                                        <option value="publish">Publish (Langsung Tampil)</option>
                                        <option value="draft">Draft (Simpan Sementara)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Konten</label>
                                    <textarea name="content" id="editor" class="form-control" rows="5" placeholder="Tulis isi artikel di sini..."></textarea>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Terbitkan Artikel</button>
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
            // Mengaktifkan fitur popup pencarian ketik pada select option tag
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: " Klik dan pilih beberapa tag...",
                allowClear: true
            });

            // Mengaktifkan select2 juga untuk kategori tunggal agar serasi dan bisa dicari
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