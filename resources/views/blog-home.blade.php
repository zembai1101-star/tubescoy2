<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Eden - Portal Blog & Magazine</title>

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/magnific-popup.css') }}">
    
    <link rel="stylesheet" href="{{ asset('front/style.css') }}">
</head>ead>ader>

    <div class="main-content-wrapper section-padding-100">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-12 col-lg-8">
                    <div class="recent-posts-area">
                        <div class="title mb-4 border-bottom-2px pb-2">
                            <h4 class="font-weight-bold text-dark"><i class="fa fa-newspaper-o mr-2 text-danger"></i>Artikel Terbaru</h4>
                        </div>

                        <div class="row">
                            @forelse($posts as $post)
                                <div class="col-12 col-md-6 mb-4">
                                    <div class="single-recent-post-with-thumb shadow-sm bg-white rounded overflow-hidden h-100 d-flex flex-column" style="border: 1px solid #eee;">
                                        
                                        <div class="post-thumb" style="height: 200px; overflow: hidden; background: #f8f9fa;">
                                            @if($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                                    <i class="fa fa-picture-o fa-2x mb-2" style="opacity: 0.3;"></i>
                                                    <small class="font-weight-bold text-uppercase">No Image</small>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="post-content p-3 d-flex flex-column flex-grow-1">
                                            <span class="text-uppercase font-weight-bold text-danger small mb-1 d-block">
                                                {{ $post->category->name ?? 'Umum' }}
                                            </span>
                                            
                                            <h5 class="font-weight-bold mb-2">
                                                <a href="{{ route('blog.show', $post->slug) }}" class="text-dark hover-danger">{{ $post->title }}</a>
                                            </h5>
                                            
                                            <p class="text-muted small mb-2">
                                                <i class="fa fa-calendar-o mr-1"></i> {{ $post->created_at->format('d M Y') }}
                                            </p>

                                            <p class="text-secondary small flex-grow-1">
                                                {!! Str::limit(strip_tags($post->content), 100) !!}
                                            </p>

                                            <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                                                <div class="tags-wrapper">
                                                    @forelse($post->tags as $tag)
                                                        <span class="badge badge-light border text-muted mr-1">#{{ $tag->name }}</span>
                                                    @empty
                                                        <small class="text-muted">-</small>
                                                    @endforelse
                                                </div>
                                                
                                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm px-3" style="border-radius: 20px; font-weight: 600;">
                                                    Baca <i class="fa fa-arrow-right ml-1" style="font-size: 11px;"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <i class="fa fa-folder-open-o fa-3x text-muted mb-3" style="opacity: 0.5;"></i>
                                    <h5 class="text-muted font-weight-bold">Belum Ada Artikel yang Diterbitkan</h5>
                                    <p class="text-muted small">Silakan tambah atau ubah status artikel menjadi Publish di halaman admin.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="sidebar-area border p-3 bg-white rounded shadow-sm">
                        <div class="single-sidebar-widget mb-4">
                            <h5 class="widget-title font-weight-bold border-bottom pb-2 mb-3">Tentang Kami</h5>
                            <p class="text-muted small">Welcome to Eden Blog! Portal artikel gokil kreasi <b>kami betige gokil</b> yang terintegrasi langsung dengan AdminLTE 4.</p>
                        </div>

                        <div class="single-sidebar-widget">
                            <h5 class="widget-title font-weight-bold border-bottom pb-2 mb-3">Ikuti Kami</h5>
                            <div class="d-flex justify-content-around">
                                <a href="#" class="btn btn-outline-primary btn-sm btn-block mr-1"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="btn btn-outline-info btn-sm btn-block mx-1"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="btn btn-outline-danger btn-sm btn-block ml-1"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="footer-area bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 small text-muted">Copyright &copy; 2026 <b>kami betige gokil</b>. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('front/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('front/js/active.js') }}"></script>
</body>
<script src="{{ asset('front/js/jquery/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/plugins/plugins.js') }}"></script>
    <script src="{{ asset('front/js/active.js') }}"></script>
</body>
</html>