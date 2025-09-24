<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const themeController = document.querySelector('.theme-controller');
                const logo = document.getElementById('main-logo');

                if (!themeController) {
                    console.error('Theme controller tidak ditemukan');
                    return;
                }

                if (!logo) {
                    console.error('Logo tidak ditemukan');
                    return;
                }

                // Ambil tema dari localStorage atau default ke dark
                const savedTheme = localStorage.getItem('theme') || 'dark';

                function updateTheme(isDark) {
                    // Update data-theme pada html element
                    document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');

                    // Update checkbox state
                    themeController.checked = isDark;

                    // Update logo
                    if (logo) {
                        logo.src = isDark ?
                            "{{ asset('img/logo-dark.svg') }}" :
                            "{{ asset('img/logo-light.svg') }}";
                    }

                    // Simpan ke localStorage
                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                }

                // Set tema awal
                updateTheme(savedTheme === 'dark');

                // Event listener untuk perubahan tema
                themeController.addEventListener('change', function() {
                    updateTheme(this.checked);
                });

            }, 100);
        });
    </script>
    @stack('scripts')
</body>

</html>
