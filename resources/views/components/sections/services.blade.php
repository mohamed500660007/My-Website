<section id="services" class="py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mb-16 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">خدماتي</span>
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">الخدمات</h2>
            <p class="font-subheading text-xl text-muted-foreground max-w-2xl mx-auto">
                حلول تقنية متكاملة تناسب احتياجاتك
            </p>
        </div>

        @php
            $services = [
                ['icon' => 'code-2',   'title' => 'تطوير مواقع ويب',        'description' => 'بناء مواقع ويب حديثة وسريعة باستخدام أحدث التقنيات مثل Laravel و React'],
                ['icon' => 'rocket',   'title' => 'بناء أنظمة SaaS',        'description' => 'تصميم وتطوير منصات SaaS متكاملة قابلة للتوسع مع بنية تحتية قوية'],
                ['icon' => 'brain',    'title' => 'دمج الذكاء الاصطناعي',  'description' => 'إضافة قدرات AI لتطبيقاتك لتحسين تجربة المستخدم والأتمتة الذكية'],
                ['icon' => 'sparkles', 'title' => 'استشارات تقنية',        'description' => 'مساعدتك في اختيار أفضل التقنيات والحلول المناسبة لمشروعك'],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $index => $service)
                <div
                    x-data="{ show: false }" x-intersect.once="show = true"
                    class="group relative bg-card border border-border rounded-2xl p-8 card-glow hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-2"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: {{ $index * 100 }}ms; transition-duration: 500ms;"
                >
                    <div class="absolute top-0 right-0 w-20 h-20 bg-primary/5 rounded-bl-[60px] -z-0 group-hover:w-24 group-hover:h-24 transition-all"></div>

                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center mb-6 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                            <i data-lucide="{{ $service['icon'] }}" class="w-7 h-7 text-primary group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold mb-3">{{ $service['title'] }}</h3>
                        <p class="font-body text-muted-foreground leading-relaxed">{{ $service['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
