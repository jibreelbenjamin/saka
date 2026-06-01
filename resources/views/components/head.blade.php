<!DOCTYPE html>
<html lang="en" class="scroll-smooth relative h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/fav.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/fav.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/fav.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ (isset($page)) ? ucfirst($page).' - ' : '' }}SAKA Sistem Transparansi Akademik</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <script>
        const html = document.querySelector('html');
        const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') === 'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
        const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches);
        const _serverTime = (function () {
            const serverStart = new Date("{{ now()->format('Y-m-d H:i:s') }}").getTime();
            const clientStart = Date.now();

            function now() {
                return new Date(serverStart + (Date.now() - clientStart));
            }

            return {
                now
            };
        })();
        const server_time = _serverTime.now()

        if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
        else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
        else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
        else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');

        function updateClock() {
            const el = document.getElementById('clock');
            if (!el) return;

            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };

            el.textContent = server_time.toLocaleTimeString('id-ID', options);
            server_time.setSeconds(server_time.getSeconds() + 1);
        }

        setInterval(updateClock, 1000);
    </script>
</head>
<body class="bg-gray-50 dark:bg-neutral-900 h-full">
    {{ $slot }}
</body>
</html>