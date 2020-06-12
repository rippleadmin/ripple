<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Water Admin</title>

    <!-- Styles -->
    @foreach (Water::$css as $name => $css)
    <link href="{{ route('water.asset', $name) }}" rel="stylesheet">
    @endforeach
</head>

<body class="bg-purple-100">

    @inertia

    <!-- Scripts -->
    <script src="{{ route('water.asset', 'water-admin.js') }}"></script>

    @foreach (Water::$js as $name => $js)
    <script src="{{ route('water.asset', $name) }}"></script>
    @endforeach

    <script src="{{ route('water.asset', 'water-admin-main.js') }}"></script>
    <script>
    Water.initInertiaApp();
    </script>

</body>
</html>
