<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Water Admin</title>
</head>

<body class="bg-purple-100">

    @inertia

    <!-- Scripts -->
    <script src="{{ asset(mix('/js/vendor.js', 'vendor/water-admin')) }}"></script>

    @foreach (Water::$js as $name => $js)
    <script src="{{ $js }}"></script>
    @endforeach

    <script src="{{ asset(mix('/js/app.js', 'vendor/water-admin')) }}"></script>
    <script>
    Water.initInertiaApp();
    </script>

</body>
</html>
