<nav
    x-data="{ isOpen: false, scrolled: false }"
    @scroll.window="scrolled = (window.scrollY > 20)"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
>
    {{-- Navbar container with glass effect on scroll --}}
    <div
        :class="scrolled ? 'bg-background/80 backdrop-blur-2xl shadow-lg shadow-black/5 border-b border-border/50' : 'bg-transparent border-b border-transparent'"
        class="transition-all duration-500"
    >
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center group-hover:scale-105 transition-transform">
                        <span class="text-white font-heading font-bold text-sm">A</span>
                    </div>
                    <span class="font-heading text-lg font-bold text-foreground hidden sm:inline">أحمد</span>
                </a>

                {{-- Center Nav Links --}}
                <div class="hidden md:flex items-center">
                    <div class="flex items-center bg-secondary/50 rounded-full px-1.5 py-1">
                        @php
                            $navLinks = [
                                ['href' => '/#projects', 'label' => 'المشاريع'],
                                ['href' => '/#services', 'label' => 'الخدمات'],
                                ['href' => '/#about', 'label' => 'عني'],
                                ['href' => '/#blog', 'label' => 'المدونة'],
                                ['href' => '/#contact', 'label' => 'تواصل'],
                            ];
                        @endphp

                        @foreach($navLinks as $link)
                            <a
                                href="{{ $link['href'] }}"
                                class="font-ui text-[13px] px-4 py-1.5 rounded-full text-muted-foreground hover:text-foreground hover:bg-background transition-all"
                            >
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="hidden md:flex items-center gap-3">
                    <x-dark-mode-toggle />
                    <a href="/#contact"
                        class="font-ui text-[13px] px-5 py-2 bg-primary text-white rounded-full hover:bg-primary/90 transition-all hover:shadow-md hover:shadow-primary/20 font-semibold">
                        ابدأ مشروعك
                    </a>
                </div>

                {{-- Mobile Toggle --}}
                <div class="flex items-center gap-3 md:hidden">
                    <x-dark-mode-toggle />
                    <button
                        @click="isOpen = !isOpen"
                        class="p-2 text-foreground rounded-lg hover:bg-secondary transition-colors"
                        aria-label="القائمة"
                    >
                        <i x-show="!isOpen" data-lucide="menu" class="w-5 h-5"></i>
                        <i x-show="isOpen" data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        x-show="isOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="md:hidden bg-background/95 backdrop-blur-2xl border-b border-border shadow-xl"
    >
        <div class="max-w-6xl mx-auto px-4 py-3 space-y-1">
            @foreach($navLinks as $link)
                <a
                    href="{{ $link['href'] }}"
                    @click="isOpen = false"
                    class="font-ui block py-2.5 px-4 rounded-xl text-sm text-muted-foreground hover:text-foreground hover:bg-secondary/50 transition-all"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="pt-2">
                <a href="/#contact"
                    @click="isOpen = false"
                    class="font-ui block text-center py-3 px-4 bg-primary text-white rounded-xl text-sm font-semibold hover:bg-primary/90 transition-all">
                    ابدأ مشروعك
                </a>
            </div>
        </div>
    </div>
</nav>
