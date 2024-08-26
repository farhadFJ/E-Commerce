<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Stil für benutzerdefinierten Footer */
        .footer {
            background-color: #333;
            color: white;
            padding: 20px 0;
        }

        .footer a {
            color: white;
        }

        .footer a:hover {
            text-decoration: none;
        }

        /* Hinzufügen von Padding für Logo-Elemente */
        .footer-logo {
            padding: 5px;
        }
    </style>
</head>
<body>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Links</h3>
                <ul>
                    <li><a href="{{ route('home') }}">Startseite</a></li>
                    <li><a href="{{ route('productFooterList') }}">Produkte</a></li>
                    <li><a href="#">Kontakt</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Datenschutz</h3>
                <ul>
                    <img src="{{ asset('storage/images/DSGVO.jpg') }}" alt="DSGVO Logo" class="footer-logo " width="40" height="40">
                    <li><a href="#">Datenschutzrichtlinien</a></li>
                    <li><a href="#">Cookie-Einstellungen</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h3>Zahlungsmethoden</h3>
                <img src="{{ asset('storage/images/paypal.jpg') }}" alt="PayPal Logo" class="footer-logo " width="40" height="40">
                <img src="{{ asset('storage/images/visa.jpg') }}" alt="Visa Logo" class="footer-logo" width="40" height="40">
                <img src="{{ asset('storage/images/amex.jpg') }}" alt="American Express Logo" class="footer-logo" width="40" height="40">
                <img src="{{ asset('storage/images/mastercard.jpg') }}" alt="MasterCard Logo" class="footer-logo" width="40" height="40">
                <img src="{{ asset('storage/images/klarna.jpg') }}" alt="MasterCard Logo" class="footer-logo" width="40" height="40">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>
                    Unsere Partner und wir verwenden Cookies und Daten Ihres Geräts, die nicht vertraulich sind,
                    um unsere Produkte zu verbessern und Werbung sowie weitere Inhalte auf dieser Website zu personalisieren.
                    Sie können diese Vorgänge komplett oder teilweise akzeptieren. Lesen Sie unsere Datenschutzrichtlinie,
                    um mehr über Cookies, unsere Partner, unsere Verwendung Ihrer Daten und Ihre Optionen bezüglich dieser Vorgänge bei jedem Partner zu erfahren.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <img src="{{ asset('storage/images/germany.png') }}" alt="MasterCard Logo" class="footer-logo" width="60" height="60">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
