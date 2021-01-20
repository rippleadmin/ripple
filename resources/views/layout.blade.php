<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Ripple Admin</title>

    <!-- Styles -->
    @foreach (Ripple::styles() as $asset)
    <link href="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}" rel="stylesheet">
    @endforeach

    @routes('ripple')
</head>

<body class="bg-purple-100">

    @inertia

    <!-- Scripts -->
    <script src="{{ asset(mix('js/ripple-admin.js', 'vendor/ripple-admin')) }}"></script>

    @foreach (Ripple::scripts() as $asset)
    <script src="{{ asset(mix($asset->path(), $asset->manifestDirectory())) }}"></script>
    @endforeach

    <script src="{{ asset(mix('js/main.js', 'vendor/ripple-admin')) }}"></script>
    <script>
    Ripple.initialApp();
    </script>

</body>
</html>
