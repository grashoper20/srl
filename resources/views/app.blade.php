<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SRL</title>
        <link rel="stylesheet" href="{{url('/css/app.css')}}">
        <script type="text/javascript">
            var srl = {
                settings: {
                    baseURL: '{{ url('/') }}'
                }
            };
        </script>
    </head>
    <body>
        <div id="app">
            <headnav></headnav>
            <section>
                <router-view></router-view>
            </section>
        </div>
        <script src="{{ url(mix('js/app.js')) }}"></script>
        {{--<script src="/js/app.js"></script>--}}
    </body>
</html>
