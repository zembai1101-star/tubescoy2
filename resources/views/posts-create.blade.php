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
                                    <input type="text" name="title" class="form-control" placeholder="Masukkan judul..."
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tags (Pilih beberapa jika ada)</label>
                                    <div class="row">
                                        @foreach($tags as $tag)
                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="tags[]"
                                                        id="tag-{{ $tag->id }}" value="{{ $tag->id }}">
                                                    <label for="tag-{{ $tag->id }}"
                                                        class="custom-control-label">#{{ $tag->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Thumbnail / Foto Artikel</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile"
                                                accept="image/*">
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
                                    <textarea name="content" id="editor" class="form-control" rows="5"
                                        placeholder="Tulis isi artikel di sini..."></textarea>
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
@endsection