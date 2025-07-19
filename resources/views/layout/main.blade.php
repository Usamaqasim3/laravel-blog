<!DOCTYPE html>
<html>
<head>
    <title>Blog Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@yield('content')


@stack('scripts')

</body>
</html>
