<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- SEO --}}
    <title>{{ $title ?? 'Welcome to MiracleVotes' }}</title>
    <meta name="description" content="{{ $description ?? 'Vote for your favorite platform. Choose Facebook or Instagram to continue.' }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $ogTitle ?? 'Vote Now - MiracleVotes' }}">
    <meta property="og:description" content="{{ $ogDescription ?? 'Cast your vote through Facebook or Instagram quickly and easily.' }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    @stack('styles')
</head>
<body>

    @yield('content')

    @stack('scripts')
</body>
</html>
