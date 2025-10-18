<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="drawer lg:drawer-open min-h-screen">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col min-h-screen">
            <!-- NAVBAR -->
            @include('component.navbar')
            <!-- CONTENT -->
            <main class="p-6">
                @yield('content')
            </main>
            <!-- FOOTER -->
            <footer
                class="footer footer-horizontal items-center p-4 bg-base-100 text-base-content/70 border-t border-base-100 sticky bottom-0 z-40 mt-auto justify-between">
                <div class="flex flex-row gap-2 items-center">
                    <div class="flex flex-row gap-1 items-center">
                        <a href="https://github.com/adityarifkiy16" target="_blank" class="link link-hover">
                            <img src="{{ asset('img/social-media/github-svgrepo-com.svg') }}" alt=""
                                class="w-9">
                        </a>
                        <a href="https://linkedin.com/in/adityarifkiyuliatama" target="_blank" class="link link-hover">
                            <img src="{{ asset('img/social-media/linkedin-svgrepo-com.svg') }}" alt=""
                                class="w-8">
                        </a>
                    </div>
                    <div class="flex flex-row gap-1">
                        <span>Developed by</span>
                        <a href="https://github.com/adityarifkiy16" target="_blank"
                            class="link link-hover underline">Aditya Rifki
                            Yuliatama</a>
                    </div>
                </div>
                <p class="flex flex-row gap-1 font-semibold text-gray-500 capitalize">&copy;{{ date('Y') }}
                    {{ env('APP_NAME') }}. All rights
                    reserved.</p>

            </footer>
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
