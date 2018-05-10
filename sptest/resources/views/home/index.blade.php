<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    </head>
    <body class="vertical-center">

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="title text-center">Test</div>
                        </div>
                        {{ Form::open() }}
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    {{ Form::label('airport', 'Airport') }}
                                    {{ Form::select('airport', ['' => 'Select', '1' => 'Manchester'], null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('dateA', 'From') }}
                                    {{ Form::date('dateA', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('dateB', 'To') }}
                                    {{ Form::date('dateB', null, ['class' => 'form-control', 'required']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    {{ Form::label('quoteID', 'Quote ID') }}
                                    {{ Form::text('quoteID', null, ['class' => 'form-control', 'required']) }}
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            {{ Form::submit('Submit', ['class' => 'btn btn-sm btn-primary'])}}
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
