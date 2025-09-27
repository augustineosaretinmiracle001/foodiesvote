<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ auth('admin')->user()->theme ?? 'light' }}" class="@auth('admin'){{ auth('admin')->user()->theme === 'dark' ? 'dark' : '' }}@endauth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Admin Panel' }} - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- System Theme Detection -->
        <script>
            // Detect system theme preference
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (systemPrefersDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            
            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (e.matches) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            });
        </script>
        
        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite(['resources/css/admin/admin.css', 'resources/js/admin/admin.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        {{ $styles ?? '' }}
        @stack('styles')
    </head>
    <body class="font-sans antialiased overflow-x-hidden bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">
        @if($showNavigation ?? true)
            <div class="flex min-h-screen bg-gray-50 dark:bg-gray-900 overflow-x-hidden">
                <!-- Admin Sidebar -->
                @include('components.saheed.admin.sidebar')

                <!-- Content Wrapper -->
                <div id="main-content" class="flex flex-col flex-1 w-full min-h-screen transition-all duration-300 ease-in-out overflow-x-hidden" style="margin-left: 70px;">
                    <!-- Admin Top Navigation Menu -->
                    @include('components.saheed.admin.navigation-menu')

                    <!-- Page Heading -->
                    @isset($header)
                        <header class="bg-white dark:bg-gray-800 shadow">
                            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endisset

                    <!-- Page Content -->
                    <main class="flex-1 p-6 overflow-x-hidden bg-gray-50 dark:bg-gray-900">
                        {{ $slot }}
                    </main>
                </div>
            </div>
        @else
            <main>
                {{ $slot }}
            </main>
        @endif

        @stack('modals')
        @stack('scripts')
        

    </body>
</html>
