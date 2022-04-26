<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
<link href="{{ url('/public/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ url('/public/assets/dist/css/dashboard.css') }}" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">WS Neofeeder</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="{{ url('login/logout') }}">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="{{ url('dashboard') }}">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('neomahasiswa*')) ? 'active' : '' }}" href="{{ url('/neomahasiswa') }}">
              <span data-feather="file"></span>
              Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('neodosen*')) ? 'active' : '' }}" href="{{ url('/neodosen') }}">
              <span data-feather="users"></span>
              Dosen
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Perkuliahan</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Matakuliah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Substansi Kuliah
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Kurikulum
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('neokelas*')) ? 'active' : '' }}" href="{{ url('neokelas') }}">
              <span data-feather="file-text"></span>
              Kelas Perkuliahan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('neonilai*')) ? 'active' : '' }}" href="{{ url('neonilai') }}">
              <span data-feather="file-text"></span>
              Nilai Perkuliahan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (request()->is('neoakm*')) ? 'active' : '' }}" href="{{ url('neoakm') }}">
              <span data-feather="file-text"></span>
              Aktivitas Kuliah Mahasiswa
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">@yield('title') </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          
        </div>
      </div>

      <div class="container-fluid">
         @yield('container') 
      </div>
    </main>
  </div>
</div>
<!-- Modal-->
<div class="modal fade" id="modalku" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">load title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalisi">Load content....</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('/public/assets/dist/js/dashboard.js') }}"></script>
<script src="{{ url('/public/assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript">  
$(function(){
  $('body').on("click","a.modalButton,button.modalButton",function(){
    var src = $(this).attr('data-src');
    var title = $(this).attr("title");
    if(!title){
      title =  $(this).attr("data-original-title");
    }
    if(!src || src.length == 0){
      return false;
    }
    $(".modal-title").html(title);
    //$('.modal').modal();        
    $('#modalisi').html('Loading, please wait...');
    $('#modalisi').load(src);
  })
  
})
</script>
  </body>
</html>
