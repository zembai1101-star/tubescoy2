<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }} - Eden Magazine</title>
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-color: #f9f9f9;">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" style="padding: 15px 0;">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="{{ url('/home') }}" style="font-size: 24px; color: #222;">
                Eden<span style="color: #fc3f5b;">.</span>
            </a>
            <a href="{{ url('/home') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; background: #fff; padding: 30px;">
                    
                    <div class="meta-top d-flex align-items-center gap-3 mb-3" style="font-size: 14px; color: #777;">
                        <span style="background: #fc3f5b; color: #fff; padding: 3px 12px; border-radius: 4px; font-weight: 600; text-transform: uppercase; font-size: 12px;">
                            {{ $post->category ? $post->category->name : 'Blog' }}
                        </span>
                        <span>•</span>
                        <span><i class="fa fa-calendar"></i> {{ $post->created_at->format('F d, Y') }}</span>
                        <span>•</span>
                        <span style="color: #444; font-weight: 500;"><i class="fa fa-eye"></i> {{ $post->views }} Views</span>
                    </div>

                    <h1 style="font-size: 36px; font-weight: 800; color: #222; line-height: 1.3; margin-bottom: 25px;">
                        {{ $post->title }}
                    </h1>

                    <div class="main-image-box mb-4" style="width: 100%; aspect-ratio: 16 / 9; overflow: hidden; border-radius: 8px; background: #000;">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        @else
                            <img src="{{ asset('front/img/magazine/1.jpg') }}" alt="Default" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                        @endif
                    </div>

                    <div class="article-content" style="font-size: 18px; color: #333; line-height: 1.8; letter-spacing: 0.2px;">
                        {!! nl2br($post->content) !!}
                    </div>

                    @if($post->tags->count() > 0)
                        <div class="mt-5 pt-4 border-top">
                            <span class="font-weight-bold mr-2" style="color: #222;">Tags:</span>
                            @foreach($post->tags as $tag)
                                <span class="badge badge-light px-3 py-2 mr-2" style="font-size: 13px; color: #666; border: 1px solid #ddd;">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <hr class="my-5" style="border-top: 1px dashed #ddd;">

                    <div class="comment-section mt-4">
                        <h4 class="mb-4 font-weight-bold" style="color: #222;">
                            <i class="fa fa-comments text-muted mr-2"></i> Komentar ({{ $post->comments->count() }})
                        </h4>

                        @if(session('success'))
                            <div class="alert alert-success p-2 mb-3" style="font-size: 14px;"><i class="fa fa-check-circle"></i> {{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger p-2 mb-3" style="font-size: 14px;"><i class="fa fa-exclamation-circle"></i> {{ session('error') }}</div>
                        @endif

                        @forelse($post->comments as $comment)
                            <div class="media p-3 mb-3" style="background: #f8f9fa; border-radius: 8px; border-left: 4px solid {{ $comment->user->role === 'admin' ? '#28a745' : '#007bff' }};">
                                <div class="media-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mt-0 mb-0 font-weight-bold" style="font-size: 15px;">
                                            <i class="fa {{ $comment->user->role === 'admin' ? 'fa-user-secret text-success' : 'fa-user text-primary' }} mr-1"></i> 
                                            <span class="{{ $comment->user->role === 'admin' ? 'text-success' : 'text-dark' }}">{{ $comment->user->name }}</span>
                                            
                                            @if($comment->user->role === 'admin') 
                                                <span class="badge badge-success px-2 ml-1" style="font-size: 10px; text-transform: uppercase;">Admin</span> 
                                            @endif
                                        </h6>
                                        <small class="text-muted font-italic" style="font-size: 12px;">{{ $comment->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-0 text-secondary" style="font-size: 15px; line-height: 1.5;">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 mb-4" style="background: #f8f9fa; border-radius: 8px; border: 1px dashed #ccc;">
                                <p class="text-muted font-italic mb-0" style="font-size: 14px;">Belum ada komentar di artikel ini. Yuk, jadi yang pertama memberikan tanggapan!</p>
                            </div>
                        @endforelse

                        <div class="card mt-4 border-0" style="background: #f1f3f5; border-radius: 8px;">
                            <div class="card-body p-4">
                                <h5 class="card-title font-weight-bold mb-3" style="color: #333;"><i class="fa fa-pencil mr-1"></i> Bagikan Tanggapan Kamu</h5>
                                
                                @auth
                                    <form action="{{ route('comment.store', $post->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <textarea name="body" rows="3" class="form-control" style="border-radius: 6px; font-size: 15px; border: 1px solid #ccc;" placeholder="Ketik komentar positif kamu di sini..." required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary font-weight-bold px-4" style="background-color: #007bff; border: none; border-radius: 4px; font-size: 14px;">
                                            <i class="fa fa-paper-plane mr-1"></i> Kirim Komentar
                                        </button>
                                    </form>
                                @else
                                    <div class="text-center py-2">
                                        <p class="text-muted mb-3" style="font-size: 14px;">Kamu harus masuk ke dalam akun terlebih dahulu untuk menuliskan komentar.</p>
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm font-weight-bold px-4" style="border-radius: 4px;">
                                            <i class="fa fa-sign-in"></i> Login Sekarang
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                    </div> </div>
        </div>
    </div>

    <footer class="text-center py-4 bg-white border-top mt-5">
        <p class="text-muted mb-0" style="font-size: 14px;">&copy; {{ date('Y') }} Eden Magazine. All rights reserved.</p>
    </footer>

</body>
</html>