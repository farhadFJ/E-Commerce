<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title','Custom Auth Laravel')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('input.quantity').on('input', function() {
                    var form = $(this).closest('form');
                    form.submit(); // Das Formular automatisch senden, wenn sich der Wert ändert
                });
            });
        </script>


    </head>
    <body>
    @include('include.header')

    <br/>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif

        @yield('content')
    </div>
{{--    @yield('scripts')--}}



   @include('include.footer')
    <script src="{{ asset('public/resources/js/fullDescription.js') }}"></script>
    </body>
</html>
