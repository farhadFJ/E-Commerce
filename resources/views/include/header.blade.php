<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Page Title</title>
                <link rel="stylesheet" href="resources/css/navbar.css">

        <style>
            /* Hintergrundbild und Stile für den Container */
            .navbar-blur {
                /*background-image: url("https://images.wallpaperscraft.com/image/single/cube_dark_texture_119956_1920x1080.jpg");*/
                background-image: url("https://c1.wallpaperflare.com/preview/580/787/623/fabric-macro-detail-nobody-thumbnail.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                /*min-height: 1vh;*/
                min-width: 100%;
                /*animation: moveBackground 200s linear infinite alternate;*/

            }

            /* Animationsschlüsselrahmen */
            /*@keyframes moveBackground {*/
            /*    0% {*/
            /*        background-position: center top;*/
            /*    }*/
            /*    100% {*/
            /*        background-position: center bottom;*/
            /*    }*/
            /*}*/

            .text-white {
                color: white;
            }
            .blur{
                background-color: rgba(250,250,250 ,0.1);
                backdrop-filter: blur(0.1px);
                width: 100%;
            }
        </style>
    </head>
    <body>
    {{--<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-blur animate__animated animate__fadeInDown">--}}
    <nav class="navbar navbar-expand-lg navbar-blur animate__animated animate__fadeInDown">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{config('app.name')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        @auth
                            @if(Auth::user()->email)
                                <a class="nav-link active" aria-current="page" href="{{ route('productsList') }}">Home</a>
                            @endif
                        @endauth
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('history')}}">My Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('logout')}}">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('registration')}}">Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">Admin</a>
                        </li>
                    @endauth
                </ul>
                <span class="navbar-text">
                 @auth()
                        {{auth()->user()->name}}
                    @endauth
             </span>
            </div>
        </div>
    </nav>

    </body>
</html>
