<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <!-- Dashboard -->
                @include('layouts.dashboard')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="min-height: 100vh;">
                    <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                    </x-slot>

                    {{-- alert logged --}}
                    @if (session('confirmation_message'))
                        @include('layouts.alert', ['message' => session('success'), 'type' => 'success'])
                    @endif

                    {{-- content --}}
                    <div class="pt-3">
                        <h3 class="text-lg font-semibold mb-2" id="module-name">{{ __('Module') }}</h3>
                        <div id="module-content" class="module-content">
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>

            <script>
                // Escucha el evento clic en los enlaces de la barra lateral
                document.querySelectorAll('.nav-link').forEach(function (link) {
                    link.addEventListener('click', function () {
                        var moduleName = link.getAttribute('data-module');

                        // Actualiza el contenido del elemento h3 con el nombre del módulo
                        document.getElementById('module-name').textContent = moduleName;
                    });
                });
            </script>
</body>
</html>
