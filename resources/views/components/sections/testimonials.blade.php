<section class="py-32 bg-secondary/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mb-16 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">شهادات</span>
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">آراء العملاء</h2>
            <p class="font-subheading text-xl text-muted-foreground max-w-2xl mx-auto">شوف رأي العملاء اللي اشتغلوا معايا</p>
        </div>

        @php
            $testimonials = [
                ['id' => 1, 'name' => 'محمد علي',  'role' => 'مدير منتج', 'company' => 'شركة تقنية',    'content' => 'أحمد مطور محترف جدًا، خلص المشروع في الوقت المحدد بجودة عالية. التواصل معاه كان سهل والنتيجة فاقت التوقعات.', 'rating' => 5],
                ['id' => 2, 'name' => 'سارة أحمد', 'role' => 'مؤسسة',    'company' => 'متجر إلكتروني', 'content' => 'بنى لنا منصة تجارة إلكترونية متكاملة بكل التفاصيل اللي طلبناها. الموقع سريع وسهل والعملاء بيحبوه.',         'rating' => 5],
                ['id' => 3, 'name' => 'خالد حسن',  'role' => 'مدير تقني', 'company' => 'SaaS Platform', 'content' => 'خبرته في بناء أنظمة SaaS واضحة من أول يوم. الكود نظيف والبنية التحتية قوية. أكيد هشتغل معاه تاني.',         'rating' => 5],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials as $index => $testimonial)
                <div
                    x-data="{ show: false }" x-intersect.once="show = true"
                    class="bg-card border border-border rounded-2xl p-8 card-glow hover:shadow-xl hover:shadow-primary/5 transition-all duration-300"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: {{ $index * 100 }}ms; transition-duration: 500ms;"
                >
                    <div class="mb-6">
                        <i data-lucide="quote" class="w-8 h-8 text-primary/20"></i>
                    </div>
                    <p class="font-body text-muted-foreground mb-6 leading-relaxed">"{{ $testimonial['content'] }}"</p>
                    <div class="flex gap-1 mb-6">
                        @for($i = 0; $i < $testimonial['rating']; $i++)
                            <i data-lucide="star" class="w-4 h-4 fill-primary text-primary"></i>
                        @endfor
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white font-heading font-bold">
                            {{ mb_substr($testimonial['name'], 0, 1) }}
                        </div>
                        <div class="text-right">
                            <h4 class="font-subheading font-semibold">{{ $testimonial['name'] }}</h4>
                            <p class="font-ui text-sm text-muted-foreground">{{ $testimonial['role'] }} • {{ $testimonial['company'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
