<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" type="text/css" href="{{asset('public/')}}{{ mix('/css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('public/')}}{{ mix('css/all.css') }}">
        
    </head>
    <body>
        

    <script src="{{asset('public/')}}{{ mix('js/all.js') }}" ></script>
    </body>
</html>
