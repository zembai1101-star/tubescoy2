<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link class="icon" href="{{ asset('front/img/Fakta Aneh dan Unik.png') }}" type="image/png">
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

    @include('components.header')
    {{-- Catatan: Jika di folder components nama filenya navbar.blade.php, ganti menjadi: @include('components.navbar') --}}

    <main class="site-main" style="min-height: 60vh; padding-top: 50px; padding-bottom: 50px;">
        @yield('content')
    </main>

    @include('components.footer')


    <script src="{{ asset('front/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('front/js/popper.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front/js/stellar.js') }}"></script>
    <script src="{{ asset('front/vendors/popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('front/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('front/js/mail-script.js') }}"></script>
    
    {{-- Kita komentari contact.js bawaan template agar tidak memblokir form submit asli Laravel --}}
    {{-- <script src="{{ asset('front/js/contact.js') }}"></script> --}}
    
    <script src="{{ asset('front/js/jquery.form.js') }}"></script>
    <script src="{{ asset('front/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('front/js/theme.js') }}"></script>
</body>

</html>