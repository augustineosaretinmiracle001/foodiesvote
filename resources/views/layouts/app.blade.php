<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="yUaUElR8Nl1TgGaNusU9poo0Z8ShjAa0dSlXqRD6EZ0" />

    {{-- SEO --}}
    <title>{{ $title ?? 'Welcome to MiracleVotes' }}</title>
    <meta name="description" content="{{ $description ?? 'Security Awareness Training Platform - Educational Simulation' }}">
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="author" content="Security Training Team">
    <meta name="classification" content="Educational, Security Training">
    <meta name="rating" content="General">
    <meta name="distribution" content="Internal">
    <meta name="purpose" content="Security Awareness Training">
    
    {{-- Security Headers --}}
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">

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
