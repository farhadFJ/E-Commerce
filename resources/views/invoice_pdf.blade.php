<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Abrechnung</title>
    <!-- Fügen Sie die Bootstrap-CSS hinzu -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="my-4">Abrechnung</h1>
    <div class="row">
        <div class="col-md-6">
            @auth
                <p>{{ auth()->user()->name }}</p>
                <p>Kundennummer: {{ auth()->user()->id }}</p>
                <p>Rechnungsnummer: {{ $invoice->id }}</p>
                <p>Datum: {{ now()->format('d.m.Y H:i:s') }}</p>
            @endauth
        </div>
    </div>
    <table class="table table-bordered mt-4">
        <thead>
        <tr>
            <th style="padding-right: 100px">Productsname</th>
            <th style="padding-right: 100px">Menge</th>
            <th style="padding-right: 100px">Subtotal price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoice->products as $invoiceProduct)
            <tr>
                <td style="padding-right: 100px">{{ $invoiceProduct->product_name }}</td>
                <td style="padding-right: 100px">{{ $invoiceProduct->quantity }}</td>
                <td style="padding-right: 100px">{{ $invoiceProduct->subtotal }}€</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p class="font-weight-bold mt-4">Gesamtsumme: {{ $invoice->total }}€</p>
</div>
</body>
</html>
