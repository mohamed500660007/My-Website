<!DOCTYPE html>
<html lang="ar" dir="rtl"
    x-data="{ darkMode: localStorage.getItem('theme') !== 'light' }"
    @toggle-dark.window="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
    :class="{ 'dark': darkMode }"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="مطور برمجيات متخصص في بناء تطبيقات ويب حديثة وأنظمة SaaS">
    <title>@yield('title', 'Portfolio - بنبني منتجات رقمية تصنع الفرق')</title>

    {{-- Prevent dark mode flash --}}
    <script>
        (function(){
            if(localStorage.getItem('theme')!=='light'){
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Arabic Font Stack -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=IBM+Plex+Sans+Arabic:wght@100;200;300;400;500;600;700&family=Kufam:wght@400..900&family=Noto+Sans+Arabic:wght@100..900&family=Playpen+Sans+Arabic:wght@100..800&family=Reem+Kufi:wght@400..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.9.10/dist/dotlottie-wc.js" type="module"></script>

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine Intersect plugin -->
    <script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine.js core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-background text-foreground antialiased font-body">

    <x-navigation />

    <main>
        @yield('content')
    </main>

    <x-footer />

    <script>
        document.addEventListener('DOMContentLoaded', () => lucide.createIcons());
        // Re-init icons when Alpine renders dynamic content
        document.addEventListener('alpine:init', () => {
            Alpine.directive('icons', (el) => {
                Alpine.nextTick(() => lucide.createIcons());
            });
        });
    </script>
</body>
</html>
