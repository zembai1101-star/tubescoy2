<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
    
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('blog.home') }}" class="nav-link">
        <i class="fas fa-globe mr-1"></i> Lihat Situs (Blog)
      </a>
    </li>

    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('posts.index') }}" class="nav-link">
        <i class="fas fa-tachometer-alt mr-1"></i> Dashboard Admin
      </a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>