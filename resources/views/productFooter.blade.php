@extends('layout')
@section('title','Logout')
@section('content')

    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fügen Sie die Bootstrap-CSS hinzu -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> {{-- warenlorb symbol--}}


        {{--        popup view all--}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            /* Hintergrundbild und Stile für den Container */
            .container {
                /*background-image: url("https://images.wallpaperscraft.com/image/single/cube_dark_texture_119956_1920x1080.jpg");*/
                background-image: url("https://c1.wallpaperflare.com/preview/140/957/106/orange-cloth-sheet-fashion-clothing-design.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                /*min-height: 100vh;*/
                min-width: 100%;
                padding-left: 200px;
                padding-right: 200px;
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-right mt-2" style="margin-left: 200px">

            </div>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-xs-18 col-sm-6 col-md-4" style="margin-top: 10px;">
                <div class="img-thumbnail productlist">
                    <img src="{{asset('storage/' . $product->photo)}}" class="img-fluid" style="height: 300px; width: 100%; object-fit:cover;" >
                    <div class="caption">
                        <h4>{{$product->product_name}}</h4>
                        <p>{{$product->product_description}}</p>
                        <p><strong>preis: </strong>{{$product->price}} € </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </body>
    </html>
@endsection
