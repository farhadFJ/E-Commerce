{{--@extends('layout')--}}
{{--@section('title', 'Meine Bestellungen')--}}

{{--@section('content')--}}
{{--    <h1>Meine Bestellungen</h1>--}}

{{--    @foreach($orders as $order)--}}
{{--        <h3>Bestellnummer: {{ $order->order_number }}</h3>--}}
{{--        <p>Bestelldatum: {{ $order->created_at }}</p>--}}

{{--        <table class="table">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th>Produkt</th>--}}
{{--                <th>Menge</th>--}}
{{--                <th>Preis</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody>--}}
{{--            @foreach($order->products as $product)--}}
{{--                <tr>--}}
{{--                    <td>{{ $product->product_name }}</td>--}}
{{--                    <td>{{ $product->pivot->quantity }}</td>--}}
{{--                    <td>{{ $product->pivot->price }} €</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    @endforeach--}}
{{--@endsection--}}


{{--@extends('layout')--}}
{{--@section('title','My Orders')--}}
{{--@section('content')--}}
{{--    <div class="py-3 py-md-5">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <div class="shadow bg-white p-3">--}}
{{--                        <h4 class="mb-4">My Orders</h4>--}}
{{--                        <hr>--}}

{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-bordered border-striped">--}}
{{--                                <thead>--}}
{{--                                    <th>Order No</th>--}}
{{--                                    <th>Username</th>--}}
{{--                                    <th>Transaction No</th>--}}
{{--                                    <th>Payment Mode</th>--}}
{{--                                    <th>Ordered Date</th>--}}
{{--                                    <th>Status Message</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                    @forelse($orders as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$item->id}}</td>--}}
{{--                                            <td>{{$item->fullname}}</td>--}}
{{--                                            <td>{{$item->payment_id}}</td>--}}
{{--                                            <td>{{$item->payment_mode}}</td>--}}
{{--                                            <td>{{$item->created_at->format('d-m-Y')}}</td>--}}
{{--                                            <td>{{$item->status}}</td>--}}
{{--                                            <td><a href="{{url('orders/' .$item->id)}}" class="btn btn-primary btn-sm">View</a></td>--}}
{{--                                        </tr>--}}
{{--                                    @empty--}}
{{--                                        <tr>--}}
{{--                                            <td colspan="7">No Orders available</td>--}}
{{--                                        </tr>--}}

{{--                                    @endforelse--}}
{{--                                </tbody>--}}

{{--                            </table>--}}

{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}


@extends('layout')

@section('title', 'My Orders')

@section('content')
    <div class="container">
        <h1>My Orders</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Total Amount</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Transaction No</th>
                <th>Emails Payer</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{auth()->user()->name}}</td>
                    <td>{{ $invoice->total }} €</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>{{ $invoice->payment->payment_status ?? 'failed' }}</td>
                    <td>{{ $invoice->payment->payment_id ?? '-' }}</td>
                    <td>{{ $invoice->payment->payer_email ?? '-' }}</td>
                    <td><a class="btn btn-primary btn-block btn-sm" href="{{route('invoice.show',['id'=>$invoice->id, 'ordersList'=>true])}}">View</a></td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">No Orders available</td>
                </tr>

            @endforelse

            </tbody>
        </table>
    </div>
@endsection
