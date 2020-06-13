<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Water Admin</title>

    <!-- Styles -->
    @foreach (Water::styles() as $asset)
    <link href="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}" rel="stylesheet">
    @endforeach
</head>

<body class="bg-purple-100">

    @inertia

    <!-- Scripts -->
    <script src="{{ asset(mix('js/water-admin.js', 'vendor/water-admin')) }}"></script>

    @foreach (Water::scripts() as $asset)
    <script src="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}"></script>
    @endforeach

    <script src="{{ asset(mix('js/main.js', 'vendor/water-admin')) }}"></script>
    <script>
    Water.initInertiaApp();
    </script>

</body>
</html>
