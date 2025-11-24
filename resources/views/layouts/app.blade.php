<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'ToDOlist')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    {{-- Sidebar --}}
    @include('components.sidebar')

    <main class="ml-64 p-8">
        @yield('content')
    </main>
</body>
</html>