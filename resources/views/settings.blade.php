@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0"><i class="fas fa-cogs mr-2"></i>Pengaturan Blog</h1>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Konformasi Dasar Website</h3>
                    </div>
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Blog</label>
                                <input type="text" class="form-control" value="Blog Anjay">
                            </div>
                            <div class="form-group">
                                <label>Tagline / Deskripsi Blog</label>
                                <input type="text" class="form-control" value="Tempat berbagi cerita teknologi terbaru.">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection