<footer class="border-t border-border mt-0">
    {{-- Gradient divider --}}
    <div class="section-divider"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <a href="/" class="font-heading text-2xl font-bold text-foreground hover:text-primary transition-colors inline-block mb-4">
                    <span class="text-primary">{'</span>أحمد<span class="text-primary">'}</span>
                </a>
                <p class="font-body text-muted-foreground leading-relaxed">
                    مطور برمجيات شغوف بصنع حلول رقمية مبتكرة تحل مشاكل حقيقية وتصنع فرق
                </p>
            </div>

            <div>
                <h4 class="font-subheading font-semibold mb-4">روابط سريعة</h4>
                @php
                    $quickLinks = [
                        ['label' => 'المشاريع', 'href' => '/#projects'],
                        ['label' => 'الخدمات', 'href' => '/#services'],
                        ['label' => 'المدونة', 'href' => '/#blog'],
                        ['label' => 'تواصل', 'href' => '/#contact'],
                    ];
                @endphp
                <ul class="space-y-3">
                    @foreach($quickLinks as $link)
                        <li>
                            <a
                                href="{{ $link['href'] }}"
                                class="font-ui text-muted-foreground hover:text-primary hover:pr-1 transition-all"
                            >
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-subheading font-semibold mb-4">تابعني</h4>
                <div class="flex gap-3">
                    @php
                        $socialLinks = [
                            ['icon' => 'github', 'href' => '#', 'label' => 'GitHub'],
                            ['icon' => 'linkedin', 'href' => '#', 'label' => 'LinkedIn'],
                            ['icon' => 'twitter', 'href' => '#', 'label' => 'Twitter'],
                            ['icon' => 'mail', 'href' => '#', 'label' => 'Email'],
                        ];
                    @endphp
                    @foreach($socialLinks as $social)
                        <a
                            href="{{ $social['href'] }}"
                            class="p-2.5 rounded-xl bg-secondary text-foreground hover:bg-primary hover:text-white hover:-translate-y-0.5 transition-all"
                            aria-label="{{ $social['label'] }}"
                        >
                            <i data-lucide="{{ $social['icon'] }}" class="w-5 h-5"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-border text-center">
            <p class="font-ui text-sm text-muted-foreground">© 2026 جميع الحقوق محفوظة. صُنع بـ ❤️ و ☕</p>
        </div>
    </div>
</footer>
