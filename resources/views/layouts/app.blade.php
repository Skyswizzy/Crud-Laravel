<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#f3f1eb">
    <title>@yield('title', 'Journal') · {{ config('app.name', 'Blog') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="site-shell">
        <header class="site-header">
            <a class="brand" href="{{ route('home') }}">{{ config('app.name', 'My Journal') }}</a>
            <nav class="site-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}">Posts</a>
                <a href="{{ route('posts.create') }}" class="nav-write">New post</a>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="site-footer">A quiet place for your words.</footer>
    </div>
</body>
</html>
