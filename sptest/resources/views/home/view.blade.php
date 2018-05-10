<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test</title>

        <!-- Fonts -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body class="vertical-center">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-right">Price</th>
                            </tr>
                        </thead>
                        @foreach($results as $row)

                        <tr>
                            <td>{{ $row['product'] }}</td>
                            <td class="text-right">{{ $row['price'] }}</td>
                        </tr>
                        @endforeach

                    </table>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
