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
            <footer class="footer sm:footer-horizontal bg-base-200 text-base-content items-center p-4 bottom-0 mt-auto">
                <aside class="grid-flow-col items-center">
                    <p>&copy;{{ date('Y') }} {{ env('APP_NAME') }}. All right reserved</p>
                </aside>
                <nav class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
                    <a href="https://instagram.com/adityarifkiy">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-6" viewBox="0 0 24 24"
                            stroke="currentColor" fill="currentColor">
                            <path
                                d="M 8 3 C 5.239 3 3 5.239 3 8 L 3 16 C 3 18.761 5.239 21 8 21 L 16 21 C 18.761 21 21 18.761 21 16 L 21 8 C 21 5.239 18.761 3 16 3 L 8 3 z M 18 5 C 18.552 5 19 5.448 19 6 C 19 6.552 18.552 7 18 7 C 17.448 7 17 6.552 17 6 C 17 5.448 17.448 5 18 5 z M 12 7 C 14.761 7 17 9.239 17 12 C 17 14.761 14.761 17 12 17 C 9.239 17 7 14.761 7 12 C 7 9.239 9.239 7 12 7 z M 12 9 A 3 3 0 0 0 9 12 A 3 3 0 0 0 12 15 A 3 3 0 0 0 15 12 A 3 3 0 0 0 12 9 z">
                            </path>
                        </svg>
                    </a>
                    <a href="https://github.com/adityarifkiy16">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" class="size-6" fill="currentColor"
                            stroke="currentColor" viewBox="0 0 30 30">
                            <path
                                d="M15,3C8.373,3,3,8.373,3,15c0,5.623,3.872,10.328,9.092,11.63C12.036,26.468,12,26.28,12,26.047v-2.051 c-0.487,0-1.303,0-1.508,0c-0.821,0-1.551-0.353-1.905-1.009c-0.393-0.729-0.461-1.844-1.435-2.526 c-0.289-0.227-0.069-0.486,0.264-0.451c0.615,0.174,1.125,0.596,1.605,1.222c0.478,0.627,0.703,0.769,1.596,0.769 c0.433,0,1.081-0.025,1.691-0.121c0.328-0.833,0.895-1.6,1.588-1.962c-3.996-0.411-5.903-2.399-5.903-5.098 c0-1.162,0.495-2.286,1.336-3.233C9.053,10.647,8.706,8.73,9.435,8c1.798,0,2.885,1.166,3.146,1.481C13.477,9.174,14.461,9,15.495,9 c1.036,0,2.024,0.174,2.922,0.483C18.675,9.17,19.763,8,21.565,8c0.732,0.731,0.381,2.656,0.102,3.594 c0.836,0.945,1.328,2.066,1.328,3.226c0,2.697-1.904,4.684-5.894,5.097C18.199,20.49,19,22.1,19,23.313v2.734 c0,0.104-0.023,0.179-0.035,0.268C23.641,24.676,27,20.236,27,15C27,8.373,21.627,3,15,3z">
                            </path>
                        </svg>
                    </a>
                </nav>
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
