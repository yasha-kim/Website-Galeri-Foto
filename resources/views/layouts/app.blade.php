<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ViewPoint') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}" style="font-weight: bolder;">
                <i class="fa-solid fa-layer-group fa-2xl" style="color:#F39F5A;"></i>&nbsp;ViewPoint
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav m-2 w-100 justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" style="font-weight: bolder;">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <form method="get" action="{{ route('search') }}" style="display:flex;">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Cari">
                                </div>
                                <button type="submit" class="btn btn-warning rounded-pill" style="font-size:18px;margin-left:5px;"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </form>                        
                        </li>
                
                        <!-- <div class="form">
                            <input type="text" class="form-control form-input" placeholder="Search">
                            
                        </div> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="font-weight: bolder;">{{ __('Masuk') }}</a>
                            </li>
                            <li class="nav-item">
                                
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}" style="font-weight: bolder;">{{ __('Daftar') }}</a>
                                @endif
                            </li>
                        @else

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}" style="font-weight: bolder;">{{ Auth::user()->name }}</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Keluar') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
 
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.6.4.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pinsRadio = document.getElementById('btnradio1');
            const albumsRadio = document.getElementById('btnradio2');
            const pinsContent = document.querySelector('.content1');
            const albumsContent = document.getElementById('content2');

            pinsRadio.addEventListener('change', function() {
                if (pinsRadio.checked) {
                    pinsContent.style.display = 'block';
                    albumsContent.style.display = 'none';
                }
            });

            albumsRadio.addEventListener('change', function() {
                if (albumsRadio.checked) {
                    albumsContent.style.display = 'block';
                    pinsContent.style.display = 'none';
                }
            });
        });

        $(document).ready(function() {
            $('.image-upload').change(function() {
                var count = $(this).get(0).files.length;
                $('.image-preview').empty();
                for (var i = 0; i < count; i++) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var html = '<div class="card mb-3">';
                        html += '<img class="card-img-top" src="' + e.target.result + '" alt="Card image cap">';
                        html += '</div>';
                        $('.image-preview').append(html);
                    }
                    reader.readAsDataURL($(this).get(0).files[i]);
                }
            });

            $('.image-preview').on('click', '.card', function() {
                var index = $('.image-preview .card').index(this);
                $('.image-preview .card').removeClass('active');
                $(this).addClass('active');
                $('.image-title').val($('.image-title').eq(index).val());
                $('.image-description').val($('.image-description').eq(index).val());
                $('.form-select').val($('.form-select').eq(index).val());
            });

            $('.image-title').change(function() {
                var index = $('.image-preview .card.active').index();
                $('.image-title').eq(index).val($(this).val());
            });

            $('.image-description').change(function() {
                var index = $('.image-preview .card.active').index();
                $('.image-description').eq(index).val($(this).val());
            });

            $('.form-select').change(function() {
                var index = $('.image-preview .card.active').index();
                $('.form-select').eq(index).val($(this).val());
            });
        });

        const commentInput = document.getElementById('comment');
        const submitButton = document.getElementById('submit');

        commentInput.addEventListener('input', () => {
            if (commentInput.value.trim() !== '') {
            submitButton.style.display = 'block';
            } else {
            submitButton.style.display = 'none';
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const commentDates = document.querySelectorAll('.comment-date');

            commentDates.forEach(function (commentDate) {
                const timestamp = commentDate.getAttribute('data-timestamp');
                const relativeTime = commentDate.querySelector('.relative-time');

                function updateRelativeTime() {
                    relativeTime.textContent = moment.unix(timestamp).fromNow();
                }

                // Memperbarui waktu setiap 1 menit
                setInterval(updateRelativeTime, 60000);

                // Memanggil fungsi untuk pertama kali
                updateRelativeTime();
            });
        });
    
    </script>
</body>

</html>
