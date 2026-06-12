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

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Tags</label>
                                    <div class="row">
                                        @foreach($tags as $tag)
                                            <div class="col-md-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="tags[]" id="tag-{{ $tag->id }}" value="{{ $tag->id }}"
                                                    {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                                                    <label for="tag-{{ $tag->id }}" class="custom-control-label">#{{ $tag->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
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
@endsection