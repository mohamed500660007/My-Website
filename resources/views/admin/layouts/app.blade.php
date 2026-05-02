<!DOCTYPE html>
<html class="light" dir="rtl" lang="ar">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - نظام إدارة المحتوى</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary": "#ffffff",
                        "secondary-fixed": "#e3dfff",
                        "surface-container": "#eaedff",
                        "on-tertiary-fixed-variant": "#7d2d00",
                        "surface-bright": "#faf8ff",
                        "surface-dim": "#d2d9f4",
                        "on-secondary-fixed-variant": "#372abf",
                        "on-secondary": "#ffffff",
                        "inverse-surface": "#283044",
                        "on-background": "#131b2e",
                        "inverse-primary": "#b4c5ff",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#434655",
                        "primary-fixed": "#dbe1ff",
                        "primary": "#004ac6",
                        "on-secondary-container": "#fffbff",
                        "tertiary-fixed": "#ffdbcd",
                        "surface-variant": "#dae2fd",
                        "tertiary-fixed-dim": "#ffb596",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#dae2fd",
                        "on-error-container": "#93000a",
                        "surface": "#faf8ff",
                        "on-tertiary-fixed": "#360f00",
                        "secondary-container": "#6860ef",
                        "surface-tint": "#0053db",
                        "primary-container": "#2563eb",
                        "outline-variant": "#c3c6d7",
                        "secondary-fixed-dim": "#c3c0ff",
                        "outline": "#737686",
                        "on-surface": "#131b2e",
                        "inverse-on-surface": "#eef0ff",
                        "surface-container-high": "#e2e7ff",
                        "tertiary": "#943700",
                        "on-tertiary": "#ffffff",
                        "error": "#ba1a1a",
                        "background": "#faf8ff",
                        "on-primary-container": "#eeefff",
                        "on-primary-fixed-variant": "#003ea8",
                        "surface-container-low": "#f2f3ff",
                        "on-tertiary-container": "#ffede6",
                        "secondary": "#4e45d5",
                        "on-primary-fixed": "#00174b",
                        "primary-fixed-dim": "#b4c5ff",
                        "on-secondary-fixed": "#100069",
                        "tertiary-container": "#bc4800",
                        "on-error": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "section-gap": "3rem",
                        "sidebar-width": "280px",
                        "gutter": "1.5rem",
                        "container-padding": "2rem",
                        "unit": "4px"
                    },
                    "fontFamily": {
                        "body-lg": ["Tajawal"],
                        "h3": ["Cairo"],
                        "h2": ["Cairo"],
                        "label-sm": ["Tajawal"],
                        "button": ["Cairo"],
                        "body-md": ["Tajawal"],
                        "h1": ["Cairo"]
                    },
                    "fontSize": {
                        "body-lg": ["1.125rem", {
                            "lineHeight": "1.7",
                            "fontWeight": "400"
                        }],
                        "h3": ["1.5rem", {
                            "lineHeight": "1.4",
                            "fontWeight": "600"
                        }],
                        "h2": ["1.875rem", {
                            "lineHeight": "1.3",
                            "fontWeight": "700"
                        }],
                        "h1": ["2.25rem", {
                            "lineHeight": "1.2",
                            "fontWeight": "800"
                        }],
                        "body-md": ["1rem", {
                            "lineHeight": "1.6",
                            "fontWeight": "400"
                        }],
                        "label-sm": ["0.875rem", {
                            "lineHeight": "1.4",
                            "fontWeight": "500"
                        }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-background font-body-md">

    <!-- Sidebar -->
    <aside class="fixed top-0 right-0 h-screen w-sidebar-width bg-white border-l border-slate-200 z-50 shadow-xl">
        <div class="flex flex-col h-full">
            <!-- Logo Section -->
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-white" data-icon="dashboard">dashboard</span>
                    </div>
                    <div>
                        <h1 class="font-h1 text-lg font-black text-slate-900">لوحة التحكم</h1>
                        <p class="text-xs text-slate-500 font-tajawal">نظام إدارة المحتوى</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <!-- Active Item -->
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.dashboard') }}">
                            <span class="material-symbols-outlined" data-icon="dashboard">dashboard</span>
                            <span>لوحة التحكم</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/projects*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.projects') }}">
                            <span class="material-symbols-outlined" data-icon="folder">folder</span>
                            <span>المشاريع</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/blog*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.blog') }}">
                            <span class="material-symbols-outlined" data-icon="edit_note">edit_note</span>
                            <span>المقالات</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/services*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.services') }}">
                            <span class="material-symbols-outlined" data-icon="design_services">design_services</span>
                            <span>الخدمات</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/subscribers*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.subscribers') }}">
                            <span class="material-symbols-outlined" data-icon="group">group</span>
                            <span>المشتركون</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/messages*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.messages') }}">
                            <span class="material-symbols-outlined" data-icon="mail">mail</span>
                            <span>الرسائل</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/media*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="#">
                            <span class="material-symbols-outlined" data-icon="photo_library">photo_library</span>
                            <span>مكتبة الوسائط</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/seo*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="#">
                            <span class="material-symbols-outlined" data-icon="search_check">search_check</span>
                            <span>تحسين محركات البحث</span>
                        </a>
                    </li>
                    <li>
                        <a class="flex items-center gap-3 px-6 py-3 transition-colors duration-200 ease-in-out active:scale-95 transform {{ request()->is('admin/settings*') ? 'border-r-4 border-indigo-600 bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-50' }}" href="{{ route('admin.settings') }}">
                            <span class="material-symbols-outlined" data-icon="settings">settings</span>
                            <span>الإعدادات</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- User Profile -->
            <div class="p-6 border-t border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="flex-1">
                        <p class="text-sm font-bold text-slate-900">أحمد محمد</p>
                        <p class="text-xs text-slate-500 font-tajawal">مسؤول النظام</p>
                    </div>
                    <button class="p-2 text-slate-500 hover:text-indigo-500 transition-colors">
                        <span class="material-symbols-outlined" data-icon="logout">logout</span>
                    </button>
                </div>
            </div>
        </div>
    </aside>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 h-16 bg-white border-b border-slate-200 z-40 mr-sidebar-width">
        <div class="flex items-center justify-between h-full px-8">
            <div class="flex items-center gap-4">
                <button class="p-2 text-slate-500 hover:text-indigo-500 transition-colors">
                    <span class="material-symbols-outlined" data-icon="menu">menu</span>
                </button>
                <div class="relative">
                    <input type="text" placeholder="البحث في لوحة التحكم..." class="w-96 px-4 py-2 pr-10 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400" data-icon="search">search</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button class="p-2 text-slate-500 hover:text-indigo-500 transition-colors relative">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                    <span class="absolute top-1 left-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <button class="p-2 text-slate-500 hover:text-indigo-500 transition-colors">
                    <span class="material-symbols-outlined" data-icon="dark_mode">dark_mode</span>
                </button>
                <div class="h-8 w-px bg-slate-200 mx-2"></div>
                <div class="flex items-center gap-3">
                    <div class="text-left">
                        <p class="text-sm font-bold leading-none">أحمد محمد</p>
                        <p class="text-[11px] text-slate-500 font-tajawal">مسؤول النظام</p>
                    </div>
                    <img alt="المستخدم" class="w-10 h-10 rounded-full border-2 border-primary-container" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBejRn_ftzvQ128X-pGNPlE8a0puhofFq-HAR5YbMfBs2BW97I7ZSaoL-cWFgLo9FPVTq5lp-vPGwu_QCwuaNgppZ91W8Iqk7mBMFLijJ29nfBH-tfOpLAagPuUyPCEzcpaYr5IO2bx9smrPaY7eFDEd9xD69TZ2t6vHlKViWXCDMjpTqN-tldhmc1Ayj5iaVGE6dWTP_7MlgwYOcGCdSYESQGTker6I3Z9BChTZv1b8aVIj-YYHXQ7Q0bidjDCKiqNLGPWrrAhH7s" />
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="mr-64 pt-16 min-h-screen">
        @yield('content')
    </main>

    <!-- Toast Notifications -->
    <x-toasts />

    @stack('scripts')
</body>
</html>
