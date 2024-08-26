@extends('layout')
@section('title','Product Details')
@section('content')
   <html>
        <head>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">

            <!-- animate.css -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

            <style>
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
                    margin-top: 30px;
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

                .blur {
                    background-color: rgba(250, 250, 250, 0.1);
                    backdrop-filter: blur(0.1px);
                    width: 100%;
                }
                .back-link {
                    position: fixed;
                    top: 58px;
                    left: 20px;
                    color: orangered;
                    font-size: 24px;
                    text-decoration: none;
                    z-index: 999;
                }
            </style>
        </head>
        <body>
        <a href="{{ route('productsList') }}" class="back-link animate__animated animate__fadeInUp">
            <i class="fas fa-arrow-left fa-2x"></i>
        </a>
        <div class="container mt-4 " >
            <div class="row">
                <div class="col-md-6 mb-4">
                    <img src="{{ asset('storage/' . $product->photo) }}" alt="{{ $product->product_name }}" class="img-fluid rounded animate__animated animate__fadeInLeft">
                </div>
                <div class="col-md-6">
                    <h1 class="mb-4 animate__animated animate__fadeInRight">{{ $product->product_name }}</h1>
                    <p class="animate__animated animate__fadeInRight">{{ $product->product_description }}</p>
                    <p class="animate__animated animate__fadeInRight"><strong>Price: </strong>{{ $product->price }} €</p>
                    <p class="btn-holder animate__animated animate__fadeInRight">
                        <a href="{{route('add_to_cart',$product->id)}}" class="btn btn-primary btn-block text-center" role="button">
                            <i
                                class="fa fa-shopping-cart" aria-hidden="true">
                            </i>Add to cart
                        </a>
                    </p>
                </div>
            </div>
        </div>
        </body>
   </html>
@endsection
