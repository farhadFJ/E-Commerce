@extends('layout')
@section('title','Logout')

@section('content')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Hintergrundbild und Stile für den Container */
        .container {
            /*background-image: url("https://images.wallpaperscraft.com/image/single/cube_dark_texture_119956_1920x1080.jpg");*/
            background-image: url("https://c1.wallpaperflare.com/preview/140/957/106/orange-cloth-sheet-fashion-clothing-design.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            min-height: 100vh;
            min-width: 100%;
            padding-left: 200px;
            padding-right: 200px;
            padding-top: 30px;
            animation: moveBackground 50s linear infinite alternate;
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

    </style>
    <div class="container">
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            <h4 class="alert-heading">Fehler!</h4>
            <p>{{ $errorMessage }}</p>
            <hr>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endsection
