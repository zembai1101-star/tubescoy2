<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('front/img/Fakta Aneh dan Unik.png') }}" type="image/png">
    <title>Fakta Aneh & Unik</title>

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.css') }}">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">   
    <link rel="stylesheet" href="{{ asset('front/css/flaticon.css') }}">   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('front/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/vendors/popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
</head>

<body>

    <!--================ Start header Top Area =================-->
    <section class="header-top">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-6 col-lg-4">
                    <div class="float-left">
                        <ul class="header_social">
                            <li><a href="#"><i class="ti-facebook"></i></a></li>
                            <li><a href="#"><i class="ti-twitter"></i></a></li>
                            <li><a href="#"><i class="ti-instagram"></i></a></li>
                            <li><a href="#"><i class="ti-skype"></i></a></li>
                            <li><a href="#"><i class="ti-vimeo"></i></a></li>
                        </ul>   
                    </div>
                </div>
                    <div class="col-6 col-lg-4 col-md-6 col-sm-6 logo-wrapper text-center">
                    <a href="{{ route('index.home') }}" class="logo">
                        <!-- Ditambahkan style inline untuk membatasi tinggi logo menjadi 60px dan otomatis menyesuaikan lebar -->
                        <img src="{{ asset('front/img/Fakta Aneh dan Unik.png') }}" alt="Fakta Aneh dan Unik" style="max-height: 60px; width: auto; object-fit: contain;">
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 search-trigger">
    <div class="right-button d-flex justify-content-end align-items-center pr-3">
        <ul class="list-inline mb-0 d-flex align-items-center" style="gap: 24px;">
            <li class="list-inline-item m-0">
                <a id="search" href="javascript:void(0)"><i class="fas fa-search"></i></a>
            </li>           
            @auth
                @if(Auth::user()->role === 'admin')
                    <li class="list-inline-item m-0">
                        <a href="{{ route('admin.dashboard') }}" style="color: #28a745; font-weight: bold; white-space: nowrap;">
                            <i class="fas fa-user-shield"></i> Admin
                        </a>
                    </li>
                @else
                    <li class="list-inline-item m-0">
                        <a href="#" style="color: #007bff; font-weight: bold; display: inline-block; max-width: 120px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle;" title="{{ Auth::user()->name }}">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    </li>
                @endif
                
                <li class="list-inline-item m-0">
                    <a href="#" style="color: #dc3545; font-weight: bold; white-space: nowrap;" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-top').submit();">
                        <i class="fas fa-sign-out-alt"></i> Out
                    </a>
                </li>
                <form id="logout-form-top" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <li class="list-inline-item m-0">
                    <a href="{{ route('login') }}" style="font-weight: bold; white-space: nowrap;">
                        <i class="fas fa-user-circle"></i> Sign In
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</div>
        <div class="search_input" id="search_input_box">
            <div class="container">
                <form class="d-flex justify-content-between search-inner">
                    <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="ti-close" id="close_search" title="Close Search"></span>
                </form>
            </div>
        </div>
    </section>
    <!--================ End header top Area =================-->

    <!-- Start header Menu Area -->
    <header id="header" class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto mr-auto">
                            <li class="nav-item {{ request()->routeIs('index.home') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('index.home') }}">Home</a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#">Categories</a>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#">Archive</a>
                            </li>    
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('index.home') }}">Blog List</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('index.home') }}">Latest News</a>
                            </li>
                            <li class="nav-item {{ request()->routeIs('contact.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a>
                        </li>    
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header> 
    <!-- End header Menu Area -->

 <!--================ First block section start =================-->
   <!-- Tambahkan margin top (mt-5 atau style padding) agar judul tidak tenggelam di bawah navbar -->
<section class="choice_area p_120" style="padding-top: 40px; margin-top: 20px;">
    <div class="container">
        <div class="main_title text-center" style="margin-bottom: 40px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #222;">Artikel Populer Bulan Ini</h2>
            <p style="color: #777; font-size: 14px; margin-top: 5px;">Rekomendasi bacaan yang paling banyak dikunjungi oleh pembaca bulan ini.</p>
        </div>
        <div class="row">
            
            @if(isset($popular_posts) && $popular_posts->count() > 0)
                @foreach($popular_posts as $p_post)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="choice_item" style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 3px 12px rgba(0,0,0,0.05); height: 100%; display: flex; flex-direction: column;">
                            
                            <!-- 1. Bagian Gambar: Dibuat Landscape 16:9 Biar Proporsional, Gak Lonjong Vertikal -->
                            <a href="{{ route('blog.show', $p_post->slug) }}" class="d-block" style="width: 100%; aspect-ratio: 16 / 9; overflow: hidden; position: relative;">
                                @if($p_post->image)
                                    <img src="{{ asset('storage/' . $p_post->image) }}" alt="{{ $p_post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" class="popular-img">
                                @else
                                    <img src="{{ asset('front/img/magazine/1.jpg') }}" alt="Default" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;" class="popular-img">
                                @endif
                                
                                <!-- Badge Kategori Mengambang di Atas Gambar -->
                                <span style="position: absolute; bottom: 10px; left: 10px; background: #fc3f5b; color: #fff; padding: 3px 10px; font-size: 11px; font-weight: 600; border-radius: 3px; text-transform: uppercase;">
                                    {{ $p_post->category ? $p_post->category->name : 'Blog' }}
                                </span>
                            </a>
                            
                            <!-- 2. Bagian Konten Teks di Bawah Gambar: Bersih, Kontras Tinggi, & Gak Ketutup Gradasi Gelap -->
                            <div class="choice_text" style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; background: #fff;">
                                <div>
                                    <!-- Meta Views & Date -->
                                    <div style="font-size: 12px; color: #999; margin-bottom: 8px; display: flex; align-items: center; gap: 10px;">
                                        <span><i class="fa fa-calendar"></i> {{ $p_post->created_at->format('M d, Y') }}</span>
                                        <span>•</span>
                                        <span style="color: #666; font-weight: 500;"><i class="fa fa-eye"></i> {{ $p_post->views }} Views</span>
                                    </div>
                                    
                                    <!-- Judul Artikel -->
                                    <a href="{{ route('blog.show', $p_post->slug) }}" style="text-decoration: none;">
                                        <h4 class="popular-title" style="font-size: 18px; color: #222; font-weight: 700; line-height: 1.4; margin: 0 0 10px 0; transition: color 0.2s;">
                                            {{ Str::limit($p_post->title, 60) }}
                                        </h4>
                                    </a>
                                </div>
                                
                                <!-- Potongan Konten Singkat -->
                                <p style="color: #666; font-size: 13px; line-height: 1.5; margin: 0;">
                                    {{ Str::limit(strip_tags($p_post->content), 90) }}
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-4">
                    <p class="text-muted" style="font-style: italic;">Belum ada data artikel populer.</p>
                </div>
            @endif

        </div>
    </div>
</section>

<!-- Tambahan Style Hover Halus Biar Interaktif -->
 <div class="main_title text-center" style="margin-bottom: 40px;">
            <h2 style="font-size: 28px; font-weight: 700; color: #222;">Artikel Terbaru</h2>
            <p style="color: #777; font-size: 14px; margin-top: 5px;">baca update artikel terbaru di bawahini</p>
        </div>
<style>
    .popular-title:hover {
        color: #fc3f5b !important;
    }
    .choice_item:hover .popular-img {
        transform: scale(1.04);
    }
</style>
    <!--================ First block section end =================-->

    <!--================Fullwidth block Area =================-->
   @if($posts->count() > 0)
    @foreach($posts as $post)
        <div class="col-12 mb-4">
            <div class="single-blog" style="background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); padding: 15px;">
                
                <div class="row align-items-center">
                    
                    <div class="col-md-4">
                        <a href="{{ route('blog.show', $post->slug) }}" class="d-block">
                            <div class="thumb" style="width: 100%; aspect-ratio: 16 / 9; overflow: hidden; border-radius: 6px; background-color: #f7f7f7;">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->title }}"
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                @else
                                    <img src="{{ asset('front/img/magazine/1.jpg') }}" 
                                         alt="Default Image"
                                         style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                @endif
                            </div>
                        </a>
                    </div>

                    <div class="col-md-8">
                        <div class="short_details" style="padding: 10px 0; width: 100%;">
                            <div class="meta-top d-flex" style="font-size: 12px; margin-bottom: 8px;">
                                <a href="#" style="color: #fc3f5b; font-weight: 600; text-decoration: none;">
                                    {{ $post->category ? $post->category->name : 'Uncategorized' }}
                                </a>
                                <span class="mx-2" style="color: #999;">/</span>
                                <span style="color: #999;">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <a class="d-block" href="{{ route('blog.show', $post->slug) }}" style="text-decoration: none;">
                                <h4 class="post-title-link" style="font-size: 22px; color: #222; font-weight: 700; line-height: 1.4; margin-bottom: 10px; transition: color 0.3s;">
                                    {{ $post->title }}
                                </h4>
                            </a>
                            
                            <p style="color: #666; font-size: 14px; line-height: 1.6; margin-bottom: 0;">
                                {!! Str::limit(strip_tags($post->content), 160) !!}
                            </p>
                        </div>
                    </div>

                </div> </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center py-5">
        <h4 class="text-muted">Belum ada artikel yang diterbitkan.</h4>
    </div>
@endif

<style>
    .post-title-link:hover {
        color: #fc3f5b !important;
    }
    .thumb img {
        transition: transform 0.3s ease;
    }
    .thumb:hover img {
        transform: scale(1.05); /* Efek zoom dikit pas gambar di-hover ala YouTube */
    }
</style>
    <!--================Fullwidth block Area end =================-->


   



    <!-- ================ start footer Area ================= -->
    <footer class="footer-area">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                    <h4>About Us</h4>
                    <p>Heaven fruitful doesn't over lesser days appear creeping seasons so behold bearing days open</p>
                    <div class="footer-logo">
                        <!-- FIX: Logo Website Terkoneksi Resmi -->
                        <img src="{{ asset('front/img/logo.png') }}" alt="Footer Logo">
                    </div>
                </div>
                
                <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                    <h4>Kolabolator</h4>
                    <ul>
                        <p>Hasbi</p>
                        <p>Tiyo</p>
                        <p>Rizky</p>
                    </ul>
                </div>

                <div class="col-lg-3 col-sm-6 mb-4 mb-xl-0 single-footer-widget">
                    <h4>Contact Info</h4>
                    <div class="footer-address">
                        <p>Address : Belitung.</p>
                        <span>Phone : +8880 44338899</span>
                        <span>Email : anjay@anjay.com</span>
                    </div>
                </div>


                <div class="col-lg-3 col-sm-6 col-md-6 mb-4 mb-xl-0 single-footer-widget">
                    <h4>Newsletter</h4>
                    <p>Heaven fruitful doesn't over lesser in days. Appear creeping seasons deve behold bearing days
                        open</p>

                    <div class="form-wrap" id="mc_embed_signup">
                        <form target="_blank"
                            action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                            method="get">
                            <div class="input-group">
                                <input type="email" class="form-control" name="EMAIL" placeholder="Your Email Address"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your Email Address '">
                                <div class="input-group-append">
                                    <button class="btn click-btn" type="submit">
                                        <i class="fab fa-telegram-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <div style="position: absolute; left: -5000px;">
                                <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                            </div>

                            <div class="info"></div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="footer-bottom row align-items-center text-center text-lg-left no-gutters">
                <p class="footer-text m-0 col-lg-8 col-md-12">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is
                    made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                        target="_blank">Colorlib</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
                <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-dribbble"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- ================ End footer Area ================= -->






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('front/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/stellar.js') }}"></script>
    <script src="{{ asset('front/vendors/popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('front/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/mail-script.js') }}"></script>
    <script src="{{ asset('front/js/contact.js') }}"></script>
    <script src="{{ asset('front/js/jquery.form.js') }}"></script>
    <script src="{{ asset('front/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('front/js/theme.js') }}"></script>
</body>

</html>