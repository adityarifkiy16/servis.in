<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel + TailwindCSS + DaisyUI</title>

    <!-- Include CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @yield('content')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const themeController = document.querySelector('.theme-controller');
                const logo = document.getElementById('main-logo');
                const imageIllustration = document.querySelector('#login-illustration');

                if (!imageIllustration) {
                    console.log("Image Illustration tidak ditemukan");
                }

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

                    if (imageIllustration) {
                        imageIllustration.src = isDark ?
                            "{{ asset('img/login-dark.png') }}" :
                            "{{ asset('img/login-light.png') }}";
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
