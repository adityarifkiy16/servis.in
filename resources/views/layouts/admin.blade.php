<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-100">
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />

        <div class="drawer-content flex flex-col">
            <!-- NAVBAR -->
            @include('component.navbar')

            <!-- CONTENT -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>

        <!-- SIDEBAR -->
        @include('component.sidebar')
    </div>

    @stack('scripts')
</body>

</html>
