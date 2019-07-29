<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Laravel</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <user-detailuser></user-detailuser>
        </div>
        <script src="/js/app.js" type="text/javascript"></script>
    </body>
</html>