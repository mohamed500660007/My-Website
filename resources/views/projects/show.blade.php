@extends('layouts.app')

@section('title', $project['title'] . ' - تفاصيل المشروع')

@section('content')
<div class="pt-16"
    x-data="{
        progress: 0,
        currentSlide: 0,
        slides: {{ $project['images'] ?? [] }},
        nextSlide() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        },
        prevSlide() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
        },
        goToSlide(index) {
            this.currentSlide = index;
        },
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

    {{-- Project Header with Slider --}}
    <section class="pt-12 pb-8">
        <div class="max-w-[1100px] mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Back Link --}}
            <a href="/#projects" class="font-ui inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors mb-10 group text-sm">
                <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                العودة للمشاريع
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                {{-- Right: Title & Meta --}}
                <div>
                    <h1 class="font-heading text-3xl md:text-4xl lg:text-[2.75rem] font-bold mb-6 leading-[1.4]">{{ $project['title'] }}</h1>
                    <p class="font-subheading text-lg md:text-xl text-muted-foreground leading-relaxed mb-8">{{ $project['hook'] ?? $project['description'] }}</p>

                    {{-- Meta Row --}}
                    <div class="flex flex-wrap items-center gap-4 text-sm font-ui text-muted-foreground mb-6">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white text-xs font-heading font-bold flex-shrink-0">أ</div>
                            <span class="font-subheading font-semibold text-foreground">أحمد محمود</span>
                        </div>
                        <span class="text-border">•</span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                            <time>أبريل 2026</time>
                        </div>
                        <span class="text-border">•</span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            <span>5 دقائق</span>
                        </div>
                        @if($project['tags'] ?? [])
                        <span class="font-ui px-2.5 py-0.5 text-xs rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">{{ $project['tags'][0] ?? 'Web' }}</span>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    @if($project['demoUrl'] ?? $project['demo_url'] ?? null || $project['github_url'] ?? null)
                    <div class="flex flex-wrap gap-3">
                        @if($project['demoUrl'] ?? $project['demo_url'] ?? null)
                        <a href="{{ $project['demoUrl'] ?? $project['demo_url'] }}" target="_blank" class="font-ui inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-lg hover:shadow-primary/20 font-bold text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            معاينة مباشرة
                        </a>
                        @endif
                        @if($project['github_url'] ?? null)
                        <a href="{{ $project['github_url'] }}" target="_blank" class="font-ui inline-flex items-center gap-2 px-6 py-3 bg-secondary text-foreground rounded-xl hover:bg-muted transition-all border border-border font-bold text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            عرض الكود
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- Left: Image Slider --}}
                <div x-data="{ show: false }" x-intersect.once="show = true"
                    class="transition-all duration-700 rounded-2xl overflow-hidden shadow-lg border border-border/30 aspect-[4/3]"
                    :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'">
                    
                    {{-- Slider Container --}}
                    <div class="relative w-full h-full overflow-hidden">
                        @foreach($project['images'] as $index => $slide)
                        <div class="absolute inset-0 transition-opacity duration-500"
                             :class="currentSlide === {{ $index }} ? 'opacity-100' : 'opacity-0'">
                            <img src="{{ $slide }}" alt="{{ $project['title'] }} - Slide {{ $index + 1 }}"
                                class="w-full h-full object-cover" loading="eager">
                        </div>
                        @endforeach
                        
                        {{-- Slider Controls --}}
                        <button @click="prevSlide()" 
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button @click="nextSlide()" 
                                class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black/70 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        
                        {{-- Slide Indicators --}}
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                            @foreach($project['images'] as $index => $slide)
                            <button @click="goToSlide({{ $index }})"
                                    class="w-2 h-2 rounded-full transition-all duration-300"
                                    :class="currentSlide === {{ $index }} ? 'bg-white w-8' : 'bg-white/50'">
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-divider mt-10"></div>
        </div>
    </section>

    {{-- Main Content Area --}}
    <section class="pb-20" id="article-content">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-[1fr_280px] gap-12 lg:gap-16">

                {{-- Project Body --}}
                <div class="max-w-[700px]">
                    <article class="article-body">
                        
                        {{-- Overview Section --}}
                        <h2 id="section-overview" class="font-heading text-xl md:text-2xl font-bold mt-12 mb-6 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            نظرة عامة على المشروع
                        </h2>
                        <div class="relative group mb-12">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-primary/20 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                            <div class="relative bg-card border border-border/50 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-500">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:w-2 bg-primary/80"></div>
                                    <div class="p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <div class="w-12 h-12 rounded-xl bg-primary/5 text-primary flex items-center justify-center border border-primary/10">
                                                <i data-lucide="info" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-heading text-lg font-bold text-foreground">وصف المشروع</h3>
                                                <p class="text-xs text-muted-foreground font-ui uppercase tracking-widest">ملخص الأهداف والنتائج</p>
                                            </div>
                                        </div>
                                        <div class="font-reading text-lg md:text-xl text-muted-foreground leading-relaxed">
                                            <p>{{ $project['description'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Problem Section --}}
                        <h2 id="section-problem" class="font-heading text-xl md:text-2xl font-bold mt-16 mb-6 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            المشكلة والتحديات
                        </h2>
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-500/20 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                            <div class="relative bg-card border border-border/50 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-500">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:w-2 bg-red-500/80"></div>
                                    <div class="p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <div class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center border border-red-100">
                                                <i data-lucide="alert-circle" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-heading text-lg font-bold text-foreground">بيان المشكلة</h3>
                                                <p class="text-xs text-muted-foreground font-ui uppercase tracking-widest">التحديات التقنية والتنظيمية</p>
                                            </div>
                                        </div>
                                        <div class="font-reading text-lg md:text-xl text-muted-foreground leading-relaxed space-y-4">
                                            <p>{{ $project['problem'] }}</p>
                                        </div>
                                        
                                        {{-- Decorative Badge --}}
                                        <div class="mt-8 pt-6 border-t border-border/30 flex items-center gap-2 text-xs font-ui text-red-500 font-bold uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500 animate-pulse"></span>
                                            يتطلب حلاً فورياً ومبتكراً
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Solution Section --}}
                        <h2 id="section-solution" class="font-heading text-xl md:text-2xl font-bold mt-16 mb-6 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            الحل الهندسي
                        </h2>
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-green-500/20 to-transparent rounded-2xl blur opacity-0 group-hover:opacity-100 transition duration-1000"></div>
                            <div class="relative bg-card border border-border/50 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all duration-500">
                                <div class="flex flex-col md:flex-row">
                                    <div class="w-full md:w-2 bg-green-500/80"></div>
                                    <div class="p-8">
                                        <div class="flex items-center gap-3 mb-6">
                                            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center border border-green-100">
                                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-heading text-lg font-bold text-foreground">الحل المقترح</h3>
                                                <p class="text-xs text-muted-foreground font-ui uppercase tracking-widest">النهج والاستراتيجية</p>
                                            </div>
                                        </div>
                                        <div class="font-reading text-lg md:text-xl text-muted-foreground leading-relaxed space-y-4">
                                            <p>{{ $project['solution'] }}</p>
                                        </div>
                                        
                                        {{-- Success Badge --}}
                                        <div class="mt-8 pt-6 border-t border-border/30 flex items-center gap-2 text-xs font-ui text-green-600 font-bold uppercase tracking-tighter">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            تم التنفيذ بنجاح وكفاءة عالية
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Features Section --}}
                        @if($project['features'] ?? [])
                        <h2 id="section-features" class="font-heading text-xl md:text-2xl font-bold mt-12 mb-5 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            المميزات الرئيسية
                        </h2>
                        <div class="space-y-4 mb-6">
                            @foreach($project['features'] as $index => $feature)
                            <div class="group relative bg-card border border-border rounded-xl p-6 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300 overflow-hidden">
                                {{-- Background Pattern --}}
                                <div class="absolute inset-0 bg-gradient-to-r from-primary/5 via-transparent to-primary/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                
                                <div class="relative flex items-center gap-4">
                                    {{-- Number Badge --}}
                                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-heading font-bold text-sm flex-shrink-0">
                                        {{ $index + 1 }}
                                    </div>
                                    
                                    {{-- Feature Content --}}
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 bg-primary rounded-full"></div>
                                            <h4 class="font-subheading font-semibold text-lg text-foreground">مميزة {{ $index + 1 }}</h4>
                                        </div>
                                        <p class="font-reading text-[16px] text-muted-foreground leading-relaxed">{{ $feature }}</p>
                                    </div>
                                    
                                    {{-- Arrow Icon --}}
                                    <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Technology Section --}}
                        @if($project['technologies']->count() > 0)
                        <h2 id="section-technology" class="font-heading text-xl md:text-2xl font-bold mt-12 mb-5 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            التقنيات المستخدمة
                        </h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
                            @foreach($project['technologies'] as $technology)
                            <div class="group relative bg-gradient-to-br from-primary/5 to-primary/10 border border-primary/20 rounded-xl p-4 hover:shadow-lg hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-1">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center group-hover:bg-primary/30 transition-colors">
                                        <i data-lucide="code" class="w-5 h-5 text-primary"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-subheading font-semibold text-sm text-foreground">{{ $technology->name }}</h4>
                                        <p class="font-ui text-xs text-muted-foreground">Framework</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        {{-- Files Download Section --}}
                        <h2 id="section-files" class="font-heading text-xl md:text-2xl font-bold mt-12 mb-5 text-foreground leading-[1.5] scroll-mt-24 pb-3 border-b border-border/50">
                            ملفات المشروع
                        </h2>
                        <div class="bg-card border border-border rounded-xl p-6 mb-6">
                            <p class="font-reading text-[18px] text-muted-foreground mb-4">
                                يمكنك تحميل ملفات المشروع والتوثيق من هنا
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- SRS Document --}}
                                <div class="flex items-center justify-between p-4 bg-secondary/30 rounded-lg hover:bg-secondary transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-subheading font-semibold text-sm">SRS Document</p>
                                            <p class="font-ui text-xs text-muted-foreground">متطلبات النظام</p>
                                        </div>
                                    </div>
                                    <button class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                {{-- Source Code --}}
                                <div class="flex items-center justify-between p-4 bg-secondary/30 rounded-lg hover:bg-secondary transition-all">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-subheading font-semibold text-sm">Source Code</p>
                                            <p class="font-ui text-xs text-muted-foreground">الكود المصدري</p>
                                        </div>
                                    </div>
                                    <button class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </article>

                    {{-- Section Divider --}}
                    <div class="section-divider my-12"></div>

                    {{-- Share & Tags --}}
                    <div class="flex flex-wrap items-center justify-between gap-6">
                        <div class="flex items-center gap-3">
                            <span class="font-ui text-sm text-muted-foreground">التصنيف:</span>
                            @if($project['tags'] ?? [])
                            <span class="font-ui px-3 py-1 text-xs rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">
                                {{ $project['tags'][0] ?? 'Web' }}
                            </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="font-ui text-sm text-muted-foreground">شارك:</span>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($project['title']) }}"
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
                        <div x-data="{
                                activeSection: '',
                                init() {
                                    const observer =new IntersectionObserver((entries) => {
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
                                <h3 class="font-subheading font-bold text-sm">محتويات المشروع</h3>
                            </div>
                            <nav class="space-y-0.5">
                                <a href="#section-overview"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-overview'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    نظرة عامة
                                </a>
                                <a href="#section-problem"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-problem'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    المشكلة
                                </a>
                                <a href="#section-solution"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-solution'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    الحل
                                </a>
                                @if($project['features'] ?? [])
                                <a href="#section-features"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-features'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    المميزات الرئيسية
                                </a>
                                @endif
                                @if($project['technologies']->count() > 0)
                                <a href="#section-technology"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-technology'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    التقنيات المستخدمة
                                </a>
                                @endif
                                <a href="#section-files"
                                    class="font-ui block py-2 px-3 text-xs rounded-lg transition-all duration-200 border-r-2 leading-relaxed"
                                    :class="activeSection === 'section-files'
                                        ? 'bg-primary/10 text-primary border-primary font-semibold'
                                        : 'text-muted-foreground hover:text-foreground hover:bg-secondary/50 border-transparent'"
                                >
                                    ملفات المشروع
                                </a>
                            </nav>
                        </div>

                        {{-- Project Info --}}
                        <div class="bg-card border border-border rounded-xl p-5">
                            <h3 class="font-subheading font-bold text-sm mb-4">تفاصيل المشروع</h3>

                            {{-- Author --}}
                            <div class="flex items-center gap-3 mb-4 pb-4 border-b border-border/50">
                                <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary to-primary/50 flex items-center justify-center text-white text-sm font-heading font-bold flex-shrink-0">أ</div>
                                <div>
                                    <p class="font-subheading font-semibold text-xs">أحمد محمود</p>
                                    <p class="font-ui text-[10px] text-muted-foreground">Full Stack Developer</p>
                                </div>
                            </div>

                            {{-- Project Details --}}
                            <div class="space-y-3 text-xs">
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">الحالة</span>
                                    <span class="font-ui px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-800 border border-green-200 font-semibold">منشور</span>
                                </div>
                                @if($project['tags'] ?? [])
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">التصنيف</span>
                                    <span class="font-ui px-2 py-0.5 text-[10px] rounded-full bg-primary/10 text-primary border border-primary/20 font-semibold">{{ $project['tags'][0] ?? 'Web' }}</span>
                                </div>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">وقت القراءة</span>
                                    <span class="font-ui font-semibold">5 دقائق</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-ui text-muted-foreground">تاريخ النشر</span>
                                    <span class="font-ui font-semibold">أبريل 2026</span>
                                </div>
                            </div>
                        </div>

                        {{-- Recent Projects --}}
                        <div class="bg-card border border-border rounded-xl p-5">
                            <h3 class="font-subheading font-bold text-sm mb-4">مشاريع أخرى</h3>
                            <div class="space-y-3">
                                <a href="/projects/ai-dashboard"
                                    class="group block p-3 rounded-lg bg-secondary/30 hover:bg-secondary transition-all">
                                    <span class="font-ui text-[10px] text-primary font-semibold mb-1 block">AI</span>
                                    <h4 class="font-subheading font-semibold text-xs group-hover:text-primary transition-colors leading-relaxed">
                                        AI Dashboard
                                    </h4>
                                </a>
                                <a href="/projects/task-automation"
                                    class="group block p-3 rounded-lg bg-secondary/30 hover:bg-secondary transition-all">
                                    <span class="font-ui text-[10px] text-primary font-semibold mb-1 block">Automation</span>
                                    <h4 class="font-subheading font-semibold text-xs group-hover:text-primary transition-colors leading-relaxed">
                                        Task Automation System
                                    </h4>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <p class="text-xl text-muted-foreground mb-8">يلا نتكلم ونشوف ازاي نحققها سوا</p>
                <a href="/#contact"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/20">
                    ابدأ مشروعك
                    <i data-lucide="external-link" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection