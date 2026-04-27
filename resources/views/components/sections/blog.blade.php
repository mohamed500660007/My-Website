<section id="blog" class="py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mb-16 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">مقالات</span>
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">المدونة</h2>
            <p class="font-subheading text-xl text-muted-foreground max-w-2xl mx-auto">
                أفكار وتجارب وحلول تقنية من رحلتي في عالم البرمجة
            </p>
        </div>

        @php
            $blogPosts = [
                ['id' => 1, 'slug' => 'build-saas-from-scratch',   'title' => 'كيف تبني تطبيق SaaS ناجح من الصفر',      'excerpt' => 'دليل شامل لبناء منصة SaaS احترافية باستخدام Laravel و React مع أفضل الممارسات', 'date' => '2026-04-15', 'category' => 'تطوير',  'readTime' => '8 دقائق'],
                ['id' => 2, 'slug' => 'ai-in-web-apps',            'title' => 'دمج الذكاء الاصطناعي في تطبيقات الويب', 'excerpt' => 'تعلم كيف تضيف قدرات AI لتطبيقاتك بشكل عملي وسهل باستخدام APIs حديثة',             'date' => '2026-04-10', 'category' => 'AI',      'readTime' => '6 دقائق'],
                ['id' => 3, 'slug' => 'api-design-best-practices', 'title' => 'أفضل الممارسات في تصميم APIs',           'excerpt' => 'خطوات عملية لبناء APIs قوية وآمنة وسهلة الاستخدام',                                'date' => '2026-04-05', 'category' => 'Backend', 'readTime' => '7 دقائق'],
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($blogPosts as $index => $post)
                <article
                    x-data="{ show: false }" x-intersect.once="show = true"
                    class="group bg-card border border-border rounded-2xl overflow-hidden card-glow hover:shadow-xl hover:shadow-primary/5 transition-all duration-300 hover:-translate-y-2"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: {{ $index * 100 }}ms; transition-duration: 500ms;"
                >
                    <div class="h-48 bg-gradient-to-br from-primary/20 to-primary/5 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-card to-transparent"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i data-lucide="file-text" class="w-16 h-16 text-primary/15"></i>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="font-ui px-3 py-1 text-xs rounded-full bg-primary text-white font-semibold">{{ $post['category'] }}</span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <span class="font-ui flex items-center gap-1 text-xs text-white/80">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                {{ $post['readTime'] }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6 text-right">
                        <div class="flex items-center justify-end gap-2 font-ui text-sm text-muted-foreground mb-3">
                            <time>{{ \Carbon\Carbon::parse($post['date'])->translatedFormat('d F Y') }}</time>
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                        </div>
                        <h3 class="font-heading text-xl font-bold mb-3 group-hover:text-primary transition-colors leading-relaxed">
                            {{ $post['title'] }}
                        </h3>
                        <p class="font-body text-muted-foreground mb-4 leading-relaxed text-sm">{{ $post['excerpt'] }}</p>
                        <a href="/blog/{{ $post['slug'] }}"
                            class="font-ui inline-flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                            اقرأ المقال
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
