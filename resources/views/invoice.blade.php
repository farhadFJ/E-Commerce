@extends('layout')
@section('title','Logout')
@section('content')
    <html>
    <head>
        <title>Abrechnung</title>
        <!-- die Bootstrap-CSS hinzufügen -->
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

            .text-white {
                color: white;
            }

            .blur {
                background-color: rgba(250, 250, 250, 0.1);
                backdrop-filter: blur(0.1px);
                width: 100%;
            }
        </style>
    </head>
    <body>
    <div class="container bg-dark text-white">
        <h1 class="animate__animated animate__bounceIn">Abrechnung</h1>

        <table class="table">
            <thead>
            <span class="navbar-text blur">
                 @auth()
                    {{auth()->user()->name}} <br>
                    Kunden Nummer : {{auth()->user()->id}}<br>
                    Rechnungsnummer:  {{$invoice->id}} <br>
                    Datum: {{ now()->format('d.m.Y H:i:s') }}
                @endauth
             </span>
            <tr>
                <th>Products</th>
                <th>Menge</th>
                <th>Subtotal price</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($invoice->products as $invoiceProduct)
                <tr>
                    <td>{{ $invoiceProduct->product_name }}</td>
                    <td>{{ $invoiceProduct->quantity }}</td>
                    <td>{{ $invoiceProduct->subtotal }}€</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Hier können Sie die Gesamtsumme der Rechnung anzeigen -->
        <p class="font-weight-bold animate__animated animate__heartBeat">Totalsum: {{ $invoice->total }}€</p>
        <!-- Button zum Erstellen und Drucken eines PDFs -->

        <!-- Button zum Erstellen und Drucken eines PDFs -->
        <a href="{{ route('invoice.pdf', ['id' => $invoice->id]) }}"
           class="btn btn-primary animate__animated animate__pulse" id="generatePdfBtn" target="_blank">PDF erstellen
            und herunterladen</a>


        @if(!$ordersList)
            <!-- Button zum Auswählen der Zahlungsmethode -->
            <button type="button" class="btn btn-success animate__animated animate__bounce" data-toggle="modal"
                    data-target="#paymentModal">
                Zahlungsmethode auswählen
            </button>
            <script>
                function submitFormIfRadioChecked() {
                    // Überprüfen, ob der PayPal-Radio-Button ausgewählt ist
                    if (document.getElementById('paypalRadio').checked) {
                        // Wenn ausgewählt, das Formular übermitteln
                        document.getElementById('paymentForm').submit();
                    } else {
                        // Wenn nicht ausgewählt, eine Meldung anzeigen oder andere Aktionen durchführen
                        alert('Bitte wählen Sie eine Zahlungsmethode aus.');
                    }
                }
            </script>

            <!-- Modal für die Auswahl der Zahlungsmethode -->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-black">
                            <h5 class="modal-title" id="paymentModalLabel" style="color: gray">Payment method </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-black">
                            <!-- Auswahl der Zahlungsmethode -->
                            <h4>Select a payment method:</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypalRadio"
                                       value="paypal">
                                <label class="form-check-label" for="paypalRadio">
                                    PayPal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="klarnaRadio"
                                       value="klarna">
                                <label class="form-check-label" for="klarnaRadio">
                                    Klarna
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCardRadio"
                                       value="creditCard">
                                <label class="form-check-label" for="creditCardRadio">
                                    Kreditkarte
                                </label>
                            </div>

                            <!-- Formulare für die ausgewählte Zahlungsmethode -->
                            {{--                       @include('payment.paypal')--}}


                            <div id="klarnaForm" style="display: none;">
                                <!-- Hier das Klarna-Formular hinzufügen -->
                                <!-- Zum Beispiel: Rechnungsadresse, Bestellnummer, etc. -->
                            </div>

                            <div id="creditCardForm" style="display: none;">
                                <!-- Hier das Kreditkarten-Formular hinzufügen -->
                                <!-- Zum Beispiel: Kartennummer, Ablaufdatum, CVV, etc. -->
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                            <!-- Fügen Sie hier die Logik für die ausgewählte Zahlungsmethode hinzu -->
                        </div>
                        <div class="modal-footer">
                            <!-- Hier das Formular zur Zahlung einfügen -->
                            <form id="paymentForm" action="{{ route('paypal.payment', ['invoceId' => $invoice->id]) }}"
                                  method="post">
                                @csrf
                                <input type="hidden" name="amount" value="{{ $invoice->total }}">
                                <button type="button"
                                        class="btn btn-secondary btn-success animate__animated animate__bounce"
                                        data-dismiss="modal" onclick="submitFormIfRadioChecked()">buy
                                </button>
                            </form>

                            <!-- Hier die Fehlermeldungen anzeigen -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Fügen Sie hier die Logik für die ausgewählte Zahlungsmethode hinzu -->
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Fügen Sie die Bootstrap-JavaScript-Bibliotheken hinzu -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
@endsection
