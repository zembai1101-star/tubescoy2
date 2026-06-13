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

                </div>
            </div>
        </div>
    </div>

    <footer class="text-center py-4 bg-white border-top mt-5">
        <p class="text-muted mb-0" style="font-size: 14px;">&copy; {{ date('Y') }} Eden Magazine. All rights reserved.</p>
    </footer>

</body>
</html>