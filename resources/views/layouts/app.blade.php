<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Anjay - Admin Panel</title>
    
    @include('components.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('components.navbar')

        @include('components.sidebar')

        <div class="content-wrapper">
            @yield('content')
        </div>

        @include('components.footer')

    </div> @include('components.scripts')

</body>
</html>