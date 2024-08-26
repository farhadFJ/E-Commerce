@extends('layout')
@section('title','Logout')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> {{--feile symbole und delete symbole--}}

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
            padding-top: 50px;
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
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width: 50%">Product</th>
                <th style="width: 10%">Price</th>
                <th style="width: 8%">Quantity</th>
                <th style="width: 22%" class="text-center">Subtotal</th>
                <th style="width: 10%"></th>
            </tr>
        </thead>
        <tbody>
            @php $total=0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id=>$details)
                    @php $subtotal = $details['price'] * $details['quantity']; @endphp
                    @php $total += $subtotal; @endphp
                    <tr data-id="{{$id}}">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{asset('storage')}}/{{$details['photo']}}" width="100" height="100" class="img-responsive" style="object-fit: cover"></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{$details['product_name']}}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">{{$details['price']}} €</td>
                        <td data-th="Quantity" class="cart-update">
                            <form action="{{ route('update_cart', ['id' => $id]) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $details['quantity'] }}" class="form-control quantity" min="1" />
{{--                                <button type="submit" class="btn btn-primary btn-sm">Aktualisieren</button>--}}
                            </form>
                        </td>

                        <td data-th="Subtotal" class="text-center">{{$subtotal}} € </td>
                        <td class="actions" data-th="">
                            <form action="{{route('remove_from_cart')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $id}}">
                            <button class="btn btn-danger btn-sm cart_remove"><i class="fas fa-trash"></i>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><h3><strong>Total {{$total}} €</strong></h3></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">
                    <a href="{{url('/productsListIndex')}}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>Continue Shopping</a>
                    <form action="{{route('invoice.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id}}">
                        <button class="btn btn-success mt-2" ><i class="fa fa-credit-card">Checkout</i></button>
                    </form>
                </td>
            </tr>
        </tfoot>
    </table>
@endsection
{{--@section('scripts')--}}
{{--    <script type="text/javascript">--}}

{{--        $(".cart-update").change(function (e){--}}
{{--           e.preventDefault();--}}

{{--           var ele = $(this);--}}

{{--           $.ajax({--}}
{{--              url : '{{route('update_cart')}}',--}}
{{--               method : 'patch',--}}
{{--               data:{--}}
{{--                  _token : '{{csrf_token()}}',--}}
{{--                   id: ele.parents('tr').find('quantity').val()--}}
{{--               },--}}
{{--               success:function (response){--}}
{{--                  window.location.reload();--}}
{{--               }--}}
{{--           });--}}
{{--        });--}}


{{--        $(".cart_remove").click(function (e){--}}
{{--           e.preventDefault();--}}

{{--           --}}{{--// var ele =$(this);--}}

{{--           --}}{{--if(confirm("Do you really want to remove?")){--}}
{{--           --}}{{--    $.ajax({--}}
{{--           --}}{{--       url:'{{route('remove_from_cart')}}',--}}
{{--           --}}{{--       method: "DELETE",--}}
{{--           --}}{{--       data: {--}}
{{--           --}}{{--           _token: '{{csrf_token()}}',--}}
{{--           --}}{{--           id: ele.parents("tr").attr("data_id")--}}
{{--           --}}{{--       },--}}
{{--           --}}{{--        success:function (response){--}}
{{--           --}}{{--           window.location.reload();--}}
{{--           --}}{{--        }--}}
{{--           --}}{{--    });--}}
{{--           --}}{{--}--}}
{{--        });--}}

{{--    </script>--}}
{{--@endsection--}}



{{--@section('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function() {--}}
{{--            // Attach a click event handler to the delete buttons--}}
{{--            $(".delete-product").click(function() {--}}
{{--                // Get the product ID from the data attribute--}}
{{--                var productId = $(this).data("product-id");--}}

{{--                // Display a confirmation dialog--}}
{{--                if (confirm("Are you sure you want to delete this product?")) {--}}
{{--                    // Send an AJAX request to delete the product--}}
{{--                    $.ajax({--}}
{{--                        type: "DELETE",--}}
{{--                        url: "{{ route('remove_from_cart') }}", // Replace with your delete route--}}
{{--                        data: {--}}
{{--                            "_token": "{{ csrf_token() }}",--}}
{{--                            "id": productId--}}
{{--                        },--}}
{{--                        success: function(response) {--}}
{{--                            // Handle success (e.g., remove the product from the page)--}}
{{--                            if (response.success) {--}}
{{--                                alert("Product deleted successfully");--}}
{{--                                // Optionally, remove the product from the DOM--}}
{{--                                // $(this).closest(".product-container").remove();--}}
{{--                            } else {--}}
{{--                                alert("Failed to delete product");--}}
{{--                            }--}}
{{--                        },--}}
{{--                        error: function(xhr) {--}}
{{--                            // Handle errors--}}
{{--                            alert("Error: " + xhr.responseText);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}
