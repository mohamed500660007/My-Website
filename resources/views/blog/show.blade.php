@extends('layouts.app')

@section('title', $post['title'] . ' - المدونة')

@section('content')
<div class="pt-16"
    x-data="{
        progress: 0,
        updateProgress() {
            const article = document.getElementById('article-content');
            if (!article) return;
            const rect = article.getBoundingClientRect();
            const total = article.scrollHeight - window.innerHeight;
            const scrolled = window.scrollY - article.offsetTop + window.innerHeight;
            this.progress = Math.min(100, Math.max(0, (scrolled / total) * 100));
        }
    }"
    @scroll.window.throttle.50ms="updateProgress()"
>

    {{-- Reading Progress Bar --}}
    <div class="fixed top-16 left-0 right-0 z-40 h-0.5 bg-border/30">
        <div class="h-full bg-primary transition-all duration-150 ease-out" :style="'width: ' + progress + '%'"></div>
    </div>

    {{-- Article Header with Cover --}}
    <section class="pt-12 pb-8">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Link --}}
            <a href="/#blog" class="font-ui inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors mb-10 group text-sm">
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                العودة للمدونة
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                {{-- Right: Title & Meta --}}
                <div>
                    <h1 class="font-heading text-3xl md:text-4xl lg:text-[2.75rem] font-bold mb-6 leading-[1.4]">{{ $post['title'] }}</h1>
                    <p class="font-subheading text-lg md:text-xl text-muted-foreground leading-relaxed mb-8">{{ $post['excerpt'] }}</p>

                    {{-- Meta Row --}}
                    <div class="flex flex-wrap items-center gap-4 text-sm font-ui text-muted-foreground">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white text-xs font-heading font-bold flex-shrink-0">A</div>
                            <span class="font-subheading font-semibold text-foreground">أحمد محمود</span>
                        </div>
                        <span class="text-border">•</span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                            <time>{{ \Carbon\Carbon::parse($post['date'])->translatedFormat('d F Y') }}</time>
                        </div>
                        <span class="text-border">•</span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            <span>{{ $post['readTime'] }}</span>
                        </div>
                        <span class="font-ui px-2.5 py-0.5 text-xs rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">{{ $post['category'] }}</span>
                    </div>
                </div>

                {{-- Left: Cover Image --}}
                @if(isset($post['cover_image']))
                <div x-data="{ show: false }" x-intersect.once="show = true"
                    class="transition-all duration-700 rounded-2xl overflow-hidden shadow-lg border border-border/30 aspect-[4/3]"
                    :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                    <img src="{{ $post['cover_image'] }}" alt="{{ $post['title'] }}"
                        class="w-full h-full object-cover" loading="eager">
                </div>
                @endif
            </div>

            <div class="section-divider mt-10"></div>
        </div>
    </section>

    {{-- Main Content Area --}}
    <section class="pb-20" id="article-content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-12 lg:gap-16">

                {{-- Article Body --}}
                <div class="max-w-[700px]">
                    <article class="article-body">
                        @foreach($post['content'] as $contentIndex => $block)
                            @if($block['type'] === 'heading')
                                <h2 id="section-{{ $contentIndex }}" class="font-heading text-xl md:text-2xl font-bold mt-12 mb-5 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                                    {{ $block['text'] }}
                                </h2>
                            @elseif($block['type'] === 'paragraph')
                                <p class="font-reading text-[18px] md:text-[20px] text-muted-foreground leading-[1.9] md:leading-[2] mb-6">
                                    {{ $block['text'] }}
                                </p>
                            @elseif($block['type'] === 'image')
                                <figure class="article-image float-start me-6 ms-0 my-6 w-[50%] max-w-[350px] rounded-xl overflow-hidden shadow-md border border-border/30 sm-full-width">
                                    <img src="{{ $block['url'] }}" alt="{{ $block['alt'] }}"
                                        class="w-full h-auto object-cover" loading="lazy">
                                    @if(isset($block['caption']))
                                        <figcaption class="p-3 text-center text-xs font-ui text-muted-foreground bg-secondary/30">{{ $block['caption'] }}</figcaption>
                                    @endif
                                </figure>
                            @endif
                        @endforeach

                        {{-- Clear floats --}}
                        <div class="clear-both"></div>
                    </article>

                    {{-- Section Divider --}}
                    <div class="section-divider my-12"></div>

                    {{-- Share & Tags --}}
                    <div class="flex flex-wrap items-center justify-between gap-6">
                        <div class="flex items-center gap-3">
                            <span class="font-ui text-sm text-muted-foreground">التصنيف:</span>
                            <span class="font-ui px-3 py-1 text-xs rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">
                                {{ $post['category'] }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-ui text-sm text-muted-foreground">شارك:</span>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post['title']) }}"
                                target="_blank"
                                class="p-2 rounded-lg bg-secondary hover:bg-primary hover:text-white transition-all text-foreground">
                                <i data-lucide="twitter" class="w-4 h-4"></i>
                            </a>
                            <button onclick="navigator.clipboard.writeText(window.location.href)"
                                class="p-2 rounded-lg bg-secondary hover:bg-primary hover:text-white transition-all text-foreground"
                                title="نسخ الرابط">
                                <i data-lucide="link" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="mt-14 bg-card border border-border rounded-2xl p-8 md:p-10 text-center transition-all duration-600"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        <h3 class="font-heading text-xl font-bold mb-2">عندك مشروع في بالك؟</h3>
                        <p class="font-body text-muted-foreground mb-6">يلا نتكلم ونشوف ازاي نحققه سوا</p>
                        <a href="/#contact"
                            class="font-ui inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-lg hover:shadow-primary/20 font-bold text-sm">
                            تواصل معايا
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="hidden lg:block">
                    <div class="sticky top-24 space-y-6">

                        {{-- Table of Contents --}}
                        @php
                            $headings = [];
                            foreach ($post['content'] as $idx => $block) {
                                if ($block['type'] === 'heading') {
                                    $headings[] = ['index' => $idx, 'text' => $block['text']];
                                }
                            }
                        @endphp

                        @if(count($headings) > 0)
                        <div x-data="{
                                activeSection: '',
                                init() {
                                    const observer = new IntersectionObserver((entries) => {
                                        entries.forEach(entry => {
                                            if (entry.isIntersecting) {
                                                this.activeSection = entry.target.id;
                                            }
                                        });
                                    }, { rootMargin: '-20% 0px -70% 0px' });
                                    document.querySelectorAll('article h2[id]').forEach(h => observer.observe(h));
                                }
                            }"
                            class="bg-card border border-border rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-4">
                                <i data-lucide="list" class="w-4 h-4 text-primary"></i>
                                <h3 class="font-subheading font-bold text-sm">محتويات المقال</h3>
                            </div>
                            <nav class="space-y-0.5">
                                @foreach($headings as $heading)
                                    <a href="#section-{{ $heading['index'] }}"
                                        class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                        :class="activeSection === 'section-{{ $heading['index'] }}'
                                            ? 'bg-primary/10 text-primary border-primary font-semibold'
                                            : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                    >
                                        {{ $heading['text'] }}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                        @endif

                        {{-- Article Info --}}
                        <div class="bg-card border border-border rounded-xl p-5">
                            <h3 class="font-subheading font-bold text-sm mb-4">تفاصيل المقال</h3>

                            {{-- Author --}}
                            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-border/50">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white text-sm font-heading font-bold flex-shrink-0">A</div>
                                <div>
                                    <p class="font-subheading font-semibold text-xs">أحمد محمود</p>
                                    <p class="font-ui text-[10px] text-muted-foreground">Full Stack Developer</p>
                                </div>
                            </div>

                            <div class="space-y-3 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">التصنيف</span>
                                    <span class="font-ui px-2 py-0.5 text-[10px] rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">{{ $post['category'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">وقت القراءة</span>
                                    <span class="font-ui font-semibold">{{ $post['readTime'] }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">تاريخ النشر</span>
                                    <span class="font-ui font-semibold">{{ \Carbon\Carbon::parse($post['date'])->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Recent Posts --}}
                        @if(!empty($recentPosts))
                        <div class="bg-card border border-border rounded-xl p-5">
                            <h3 class="font-subheading font-bold text-sm mb-4">مقالات أخرى</h3>
                            <div class="space-y-3">
                                @foreach($recentPosts as $recent)
                                    <a href="/blog/{{ $recent['slug'] }}"
                                        class="group block p-3 rounded-lg bg-secondary/30 hover:bg-secondary transition-all">
                                        <span class="font-ui text-[10px] text-primary font-semibold mb-1 block">{{ $recent['category'] }}</span>
                                        <h4 class="font-subheading font-semibold text-xs group-hover:text-primary transition-colors leading-relaxed">
                                            {{ $recent['title'] }}
                                        </h4>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
