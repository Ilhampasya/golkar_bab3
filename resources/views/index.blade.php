<!--
    Author: Mochammad Riyadh Ilham Akbar Pasya
    Email: ilhampasya920@gmail.com

    If you found vulnerability in this site, please notify me via e-mail
-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <noscript>
            <strong>
                We're sorry but {{ config('app.name') }} doesn't work properly without JavaScript enabled. Please enable it to continue.
            </strong>
        </noscript>
        <div id="app">

        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
