@extends('layout')
@section('title','Login')
@section('content')
    <html>
        <head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> {{--login symbole --}}
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap">


            <style>
                /* Hintergrundbild und Stile für den Container */
                .container {
                    background-image: url("https://c1.wallpaperflare.com/preview/113/230/329/fabric-texture-pattern-textile.jpg");
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center;
                    min-height: 100vh;
                    min-width: 100%;
                    padding: 20px;
                    animation: moveBackground 30s linear infinite alternate;
                }

                /* Animationsschlüsselrahmen */
                @keyframes moveBackground {
                    0% {
                        background-position: center top;
                    }
                    100% {
                        background-position: center bottom;
                    }
                }

                .text-white {
                    color: white;
                }
                .blur{
                    background-color: rgba(250,250,250 ,0.1);
                    backdrop-filter: blur(1px);
                    width: 100%;
                }


            </style>
        </head>
        <body>
        <div class="text-white animate__animated animate__fadeInDown" style="font-family: 'Roboto', sans-serif;">
            <h3>Erstellen Sie Ihr Best-Konto oder melden Sie sich an.</h3>
            <p>Sind Sie bereits Best-Mitglied? Bitte verwenden Sie Ihre E-Mail-Adresse!</p>
        </div>



        <div class="container text-white">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-12 text-center">
                    <img id="zoom-image" src="{{ asset('storage/images/login2.jpg') }}" alt="MasterCard Logo" class="rounded-circle animate__animated animate__bounce" width="70" height="70">
                </div>
            </div>


            <div class="mt-5">
                @if($errors->any())
                    <div class="col-12">
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{$error}}</div>
                        @endforeach
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
            </div>
            <form action="{{ route('login.post') }}" method="post" class="ms-auto me-auto mt-3" style="width: 500px">
                @csrf
                <div class="mb-3 animate__animated animate__pulse blur">
                    <label class="form-label">Email address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__pulse blur">
                    <label class="form-label">Password</label>

                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                {{--            <button type="submit" class="btn btn-primary animate__animated animate__slideInLeft">Login</button>--}}
                <button type="submit" class="btn btn-primary animate__animated animate__slideInLeft">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
        </div>
        </body>
    </html>


@endsection
