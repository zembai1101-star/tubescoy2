@extends('layouts.app')

@section('content')
<div class="content-header pt-3 px-3">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="fas fa-eye mr-2"></i>Pratinjau Halaman</h1>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('pages.index') }}" class="btn btn-secondary float-sm-right mt-2 mt-sm-0">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Kelola Halaman
                </a>
            </div>
        </div>
    </div>
</div>

<div class="content px-3">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-body p-5">
                <h1 class="display-5 font-weight-bold text-dark mb-3">{{ $page->title }}</h1>
                
                <div class="text-muted mb-4 small">
                    <i class="fas fa-calendar-alt mr-1"></i> Terakhir Diperbarui: {{ $page->updated_at->format('d M Y H:i') }} WIB
                    <span class="mx-2">|</span>
                    <i class="fas fa-link mr-1"></i> Slug: <span class="badge badge-light text-danger">/{{ $page->slug }}</span>
                </div>
                
                <hr class="mb-4">

                <div class="page-content text-secondary" style="font-size: 1.15rem; line-height: 1.8;">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection