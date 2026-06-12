<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $post->title }} - Eden Blog</title>
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
</head>
<body>

    <header class="header-area bg-white border-bottom py-3 mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('blog.home') }}" class="text-dark font-weight-bold h4 mb-0"><i class="fa fa-arrow-left mr-2"></i> KEMBALI KЕ HOME</a>
            <span class="badge badge-danger text-uppercase px-3 py-2" style="border-radius:20px;">{{ $post->category->name ?? 'Umum' }}</span>
        </div>
    </header>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 bg-white p-4 p-md-5 rounded shadow-sm border">
                
                <h1 class="font-weight-bold text-dark mb-3">{{ $post->title }}</h1>
                
                <div class="text-muted small mb-4">
                    <i class="fa fa-calendar mr-1"></i> Dipublikasikan pada {{ $post->created_at->format('d F Y') }}
                </div>

                <div class="mb-5 rounded overflow-hidden" style="max-height: 450px; background: #f8f9fa;">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="p-5 text-center text-muted">
                            <i class="fa fa-picture-o fa-4x mb-2" style="opacity: 0.2;"></i>
                            <p>Artikel ini tidak memiliki gambar pendukung.</p>
                        </div>
                    @endif
                </div>

                <div class="article-body text-secondary" style="font-size: 17px; line-height: 1.8;">
                    {!! $post->content !!}
                </div>

                <div class="mt-5 pt-4 border-top">
                    <span class="font-weight-bold mr-2 text-dark">Tags:</span>
                    @forelse($post->tags as $tag)
                        <span class="badge badge-light border text-secondary px-3 py-2 mr-1">#{{ $tag->name }}</span>
                    @empty
                        <span class="text-muted small">-</span>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 small text-muted">Copyright &copy; 2026 <b>kami betige gokil</b>. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>