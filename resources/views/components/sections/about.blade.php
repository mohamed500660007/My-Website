<section id="about" class="py-32 bg-secondary/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div x-data="{ show: false }" x-intersect.once="show = true"
                class="transition-all duration-600"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">

                <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">تعرف عليّا</span>
                <h2 class="font-heading text-4xl md:text-5xl font-bold mb-6">عني</h2>

                <div class="space-y-4 font-body text-lg text-muted-foreground leading-relaxed">
                    <p>مرحبًا! أنا مطور برمجيات شغوف بصنع منتجات رقمية تحل مشاكل حقيقية.</p>
                    <p>بدأت رحلتي في البرمجة من أكثر من 5 سنين، ومن ساعتها بشتغل على مشاريع متنوعة من مواقع بسيطة لأنظمة SaaS معقدة.</p>
                    <p>بحب أستخدم أحدث التقنيات زي Laravel و React و AI عشان أبني حلول عصرية وفعالة.</p>
                    <p>هدفي مش بس كتابة كود نضيف، لكن فهم مشكلتك وتقديم حل يحقق أهدافك ويسعد مستخدمينك.</p>
                </div>

                @php
                    $stats = [
                        ['icon' => 'check-circle-2', 'label' => 'مشروع منجز', 'value' => '50+'],
                        ['icon' => 'award',           'label' => 'سنوات خبرة', 'value' => '5+'],
                        ['icon' => 'users',           'label' => 'عميل راضي',  'value' => '30+'],
                        ['icon' => 'zap',             'label' => 'فنجان قهوة', 'value' => '∞'],
                    ];
                @endphp

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-12">
                    @foreach($stats as $index => $stat)
                        <div
                            x-data="{ show: false }" x-intersect.once="show = true"
                            class="text-center transition-all duration-500"
                            :class="show ? 'opacity-100 scale-100' : 'opacity-0 scale-90'"
                            style="transition-delay: {{ $index * 100 }}ms;"
                        >
                            <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center">
                                <i data-lucide="{{ $stat['icon'] }}" class="w-6 h-6 text-primary"></i>
                            </div>
                            <div class="font-heading text-2xl font-bold text-primary mb-1">{{ $stat['value'] }}</div>
                            <div class="font-ui text-sm text-muted-foreground">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div x-data="{ show: false }" x-intersect.once="show = true"
                class="relative transition-all duration-600"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-4'">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/15 to-primary/5 rounded-3xl blur-3xl animate-pulse-glow"></div>
                    <div class="relative bg-card border border-border rounded-3xl p-8 shadow-2xl">
                        <div class="space-y-6">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white text-2xl font-heading font-bold">
                                    A
                                </div>
                                <div>
                                    <h3 class="font-heading text-xl font-bold">أحمد محمود</h3>
                                    <p class="font-ui text-muted-foreground">Full Stack Developer</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                @foreach([['title' => 'خبرة واسعة', 'desc' => 'اشتغلت على مشاريع في مجالات مختلفة من التجارة الإلكترونية للـ SaaS'], ['title' => 'التزام بالجودة', 'desc' => 'كل سطر كود بكتبه بيمر بمراجعة دقيقة واختبارات شاملة'], ['title' => 'تواصل مستمر', 'desc' => 'بحب أكون على تواصل دايم مع العملاء لضمان النتيجة المثالية']] as $item)
                                    <div class="flex items-start gap-3">
                                        <i data-lucide="check-circle-2" class="w-5 h-5 text-primary mt-1 flex-shrink-0"></i>
                                        <div>
                                            <h4 class="font-subheading font-semibold mb-1">{{ $item['title'] }}</h4>
                                            <p class="font-body text-sm text-muted-foreground">{{ $item['desc'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
