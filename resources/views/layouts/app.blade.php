<!DOCTYPE html>
<html>

<head>
    <title>OISHII GOHAN</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">



</head>

<body>

    <!--ヘッダー画面のコンポーネント-->
    <header>
    <x-header />
    </header>
    
    @yield('content')

 

    <x-footer />
</body>
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

</html>