@extends('layout')
@section('title', 'Create Product')
@section('content')
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fügen Sie die Bootstrap-CSS hinzu -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


        <style>
            /* Hintergrundbild und Stile für den Container */
            .container {
                /*background-image: url("https://images.wallpaperscraft.com/image/single/cube_dark_texture_119956_1920x1080.jpg");*/
                background-image: url("https://c1.wallpaperflare.com/preview/751/240/953/thread-stitch-fashion-needle-thumbnail.jpg");
                background-size: cover;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                min-height: 100vh;
                min-width: 100%;
                padding: 20px;
                animation: moveBackground 10s linear infinite alternate;
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

    </head>
    <body>
    <div class="container text-white">
        <h1 class="animate__animated animate__bounceIn" style="color: orange">Create Product</h1>
        <form action="{{ route('productsStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group animate__animated animate__fadeInUp">
                <label for="image">Choose Image</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-upload"></i></span>
                    </div>
                    <input type="file" class="form-control" id="image" name="photo">
                </div>
            </div>

            <div class="form-group animate__animated animate__fadeInUp">
                <label for="name">Product Name</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                    </div>
                    <input type="text" class="form-control" id="name" name="product_name" placeholder="Products name">
                </div>
            </div>

            <div class="form-group animate__animated animate__fadeInUp">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price">
            </div>
            <div class="form-group animate__animated animate__fadeInUp">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="product_description" placeholder="Description">
            </div>
            <button type="submit" class="btn btn-primary animate__animated animate__heartBeat">Create Product</button>
        </form>

        <h1 class="mt-5"></h1>
        <form action="{{ route('productsList') }}" method="get">
            <button type="submit" class="btn btn-secondary animate__animated animate__rubberBand" style="background-color: green">View Products List</button>
        </form>
    </div>

    <!-- Fügen Sie die Bootstrap-JavaScript-Bibliotheken hinzu -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
@endsection
