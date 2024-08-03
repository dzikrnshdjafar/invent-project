{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Mazer Admin Dashboard</title>

    <link rel="shortcut icon" href="{{ asset('mzr') }}/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('mzr') }}/assets/compiled/css/app.css">
    <link rel="stylesheet" href="{{ asset('mzr') }}/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="{{ asset('mzr') }}/assets/compiled/css/iconly.css">
    {{-- <link rel="stylesheet" href="{{ asset('mzr') }}/assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" crossorigin href="{{ asset('mzr') }}/assets/compiled/css/table-datatable.css"> --}}
    <link rel="stylesheet" href="{{ asset('mzr') }}/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
    <script src="{{ asset('mzr') }}/assets/static/js/initTheme.js"></script>
    <div id="app">
        @include('layouts.sidebar')
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading d-flex align-items-center">
                <h3>@yield('title', 'Dashboard')</h3>
                <div class="dropdown ms-auto">
                    Hello,
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <div class="px-4 py-2">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                        <form method="POST" action="{{ route('logout') }}" class="dropdown-item p-0">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="page-content"> 
                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
    <script src="{{ asset('mzr') }}/assets/static/js/components/dark.js"></script>
    <script src="{{ asset('mzr') }}/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('mzr') }}/assets/compiled/js/app.js"></script>
    <!-- Need: Apexcharts -->
    {{-- <script src="{{ asset('mzr') }}/assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('mzr') }}/assets/static/js/pages/dashboard.js"></script> --}}
{{-- 
    <script src="{{ asset('mzr') }}/assets/extensions/chart.js/chart.umd.js"></script>
    <script src="{{ asset('mzr') }}/assets/static/js/pages/ui-chartjs.js"></script> --}}

    {{-- <script src="{{ asset('mzr') }}/assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('mzr') }}/assets/static/js/pages/simple-datatables.js"></script> --}}
</body>
</html>
