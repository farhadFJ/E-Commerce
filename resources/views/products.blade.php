@extends('layout')
@section('title','Logout')
@section('content')

    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Fügen Sie die Bootstrap-CSS hinzu -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> {{-- warenlorb symbol--}}


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

            .blur {
                background-color: rgba(250, 250, 250, 0.1);
                backdrop-filter: blur(0.1px);
                width: 100%;
            }

            .link-container a {
                text-decoration: none; /* Entfernt die Unterstreichung */
                color: inherit; /* Verwendet die Standardtextfarbe */
            }

        </style>
    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-12 text-right mt-2">
                <div class="dropdown">
                    <button type="button" class="btn btn-primary" data-toggle="dropdown">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>Cart <span
                            class="badge badge-pill badge-danger">{{count((array) session('cart'))}}</span>
                    </button>
                    <div class="dropdown-menu">
                        <div class="row total-header-section">
                            @php $total=0  @endphp
                            @foreach((array)session('cart') as $id =>$details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                            @endforeach
                            <div class="col-lg-12 col-sm-12 col-12 total-section text-right">
                                <p> Total: <span class="text-info">{{$total}} €</span></p>
                            </div>
                        </div>
                        @if(session('cart'))
                            @foreach(session('cart') as $id =>$details)
                                <div class="row cart-detail" style="width: 300px;padding-right: 50px;">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="{{asset('storage')}}/{{$details['photo']}}" alt=""
                                             style="height:50px; width:50px; object-fit: contain">
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{$details['product_name']}}<br>
                                            <span class="price text-info"> {{$details['price']}} €</span><br><span
                                                class="count">Quantity:{{$details['quantity']}}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                <a href="{{route('cart')}}" class="btn btn-primary btn-block">view all</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row product-list animate__animated animate__bounceIn mx-auto" style="">

        @foreach($products as $product)

            <div class="col-xs-12 col-sm-6 col-md-3 link-container" style="margin-top: 10px;">
                <a href="{{ route('product.show',['id' =>$product->id]) }}">          {{--loading more details --}}
                    <div class="img-thumbnail productlist product-item">

                        <img src="{{asset('storage/' . $product->photo)}}" class="img-fluid"
                             style="height: 300px; width: 100%; object-fit:cover;">
                        <div class="caption">
                            <h4>{{$product->product_name}}</h4>
                            <p class="product-description"
                               style="max-height: 50px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$product->product_description}}</p>
                            <p><strong>preis: </strong>{{$product->price}} € </p>
                            <p class="btn-holder">
                                <a href="{{route('add_to_cart',$product->id)}}" class="btn btn-primary btn-block text-center" role="button">
                                    <i
                                        class="fa fa-shopping-cart" aria-hidden="true">
                                    </i>Add to cart
                                </a>
                            </p>
                            @if(Auth::user()->usertype==1 )
                                <div>
                                    <p class="btn-holder"><a href="{{ route('product.delete', ['id' => $product->id])}}"
                                                             class="btn btn-primary btn-block btn-danger text-center"
                                                             role="button"><i class="fas fa-trash"></i>Delete</a></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>

        @endforeach
    </div>


    </body>

    </html>
@endsection
