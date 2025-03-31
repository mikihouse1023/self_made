<!DOCTYPE html>
<html>

<head>
    <title>OISHII GOHAN</title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script> <!-- ←追加！ -->

</head>

<body>
<header>
    <x-header />
    </header>
   

    <main class="main-content">
    @yield('content')
    </main>
    <footer>
    <x-footer />
    </footer>
</body>
@yield('scripts')
<script type="text/javascript" src="{{ asset('js/script.js') }}"></script>

</html>