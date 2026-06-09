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

                        <form action="{{ route('posts.update', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title">Judul Artikel</label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ $post->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Kategori Artikel</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">-- Tanpa Kategori --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $post->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Pilih Tag Artikel</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach($tags as $tag)
                                            <div class="custom-control custom-checkbox mr-3 mb-2">
                                                <input class="custom-control-input" type="checkbox" name="tags[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}"
                                                    {{ $post->tags->contains($tag->id) ? 'checked' : '' }}>
                                                <label for="tag{{ $tag->id }}" class="custom-control-label font-weight-normal">#{{ $tag->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Opsi Penerbitan</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Terbitkan
                                            (Publish)</option>
                                        <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Simpan sebagai
                                            Draft</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="content">Isi Artikel</label>
                                    <textarea name="content" id="content" class="form-control" rows="10"
                                        required>{{ $post->content }}</textarea>
                                </div>

                            </div>

                            <div class="card-footer bg-white text-right">
                                <a href="{{ route('posts.index') }}" class="btn btn-default mr-2">Batal</a>
                                <button type="submit" class="btn btn-info"><i class="fas fa-save mr-1"></i> Simpan
                                    Perubahan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection