@extends('layouts.app')

@section('title', $project['title'] . ' - تفاصيل المشروع')

@section('content')
<div class="pt-16">

    {{-- Hero --}}
    <section class="relative py-20 bg-gradient-to-br from-primary/5 via-background to-accent/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
                class="transition-all duration-600"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">

                <a href="/" class="inline-flex items-center gap-2 text-muted-foreground hover:text-foreground transition-colors mb-8">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    العودة للرئيسية
                </a>

                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($project['tags'] as $tag)
                        <span class="px-4 py-2 text-sm rounded-full bg-primary/10 text-primary border border-primary/20">{{ $tag }}</span>
                    @endforeach
                </div>

                <h1 class="text-4xl md:text-6xl font-bold mb-6">{{ $project['title'] }}</h1>
                <p class="text-2xl text-muted-foreground max-w-3xl">{{ $project['hook'] }}</p>

                @if(isset($project['demoUrl']))
                    <div class="mt-8">
                        <a href="{{ $project['demoUrl'] }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/20">
                            جرّب الديمو
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-16">

                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="transition-all duration-600"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        <h2 class="text-3xl font-bold mb-6">الفكرة</h2>
                        <p class="text-lg text-muted-foreground leading-relaxed">{{ $project['description'] }}</p>
                    </div>

                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="bg-card border border-border rounded-2xl p-8 transition-all duration-600"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition-delay: 100ms;">
                        <h2 class="text-3xl font-bold mb-6">المشكلة</h2>
                        <p class="text-lg text-muted-foreground leading-relaxed">{{ $project['problem'] }}</p>
                    </div>

                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="bg-gradient-to-br from-primary/5 to-accent/5 border border-primary/20 rounded-2xl p-8 transition-all duration-600"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition-delay: 200ms;">
                        <h2 class="text-3xl font-bold mb-6">الحل</h2>
                        <p class="text-lg text-muted-foreground leading-relaxed">{{ $project['solution'] }}</p>
                    </div>

                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="transition-all duration-600"
                        :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                        style="transition-delay: 300ms;">
                        <h2 class="text-3xl font-bold mb-6">المميزات</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($project['features'] as $index => $feature)
                                <div
                                    x-data="{ show: false }" x-intersect.once="show = true"
                                    class="flex items-start gap-3 p-4 rounded-xl bg-card border border-border hover:shadow-lg transition-all"
                                    :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-4'"
                                    style="transition-delay: {{ $index * 100 }}ms; transition-duration: 500ms;"
                                >
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-primary mt-1 flex-shrink-0"></i>
                                    <span class="text-muted-foreground">{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-8">
                    <div x-data="{ show: false }" x-intersect.once="show = true"
                        class="bg-card border border-border rounded-2xl p-8 sticky top-24 shadow-lg transition-all duration-600"
                        :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-4'">

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 border border-primary/20 flex items-center justify-center">
                                <i data-lucide="code-2" class="w-6 h-6 text-primary"></i>
                            </div>
                            <h3 class="text-xl font-bold">التقنيات المستخدمة</h3>
                        </div>

                        <div class="space-y-3">
                            @foreach($project['techStack'] as $index => $tech)
                                <div
                                    x-data="{ show: false }" x-intersect.once="show = true"
                                    class="px-4 py-3 rounded-xl bg-secondary hover:bg-secondary/80 transition-colors border border-border"
                                    :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-4'"
                                    style="transition-delay: {{ $index * 50 }}ms; transition-duration: 500ms;"
                                >
                                    {{ $tech }}
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8 pt-8 border-t border-border">
                            <h4 class="font-semibold mb-4">عايز مشروع زي ده؟</h4>
                            <a href="/#contact"
                                class="block w-full px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all text-center font-bold">
                                تواصل معايا
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 bg-secondary/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div x-data="{ show: false }" x-intersect.once="show = true"
                class="transition-all duration-600"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                <h2 class="text-3xl font-bold mb-4">عندك فكرة مشابهة؟</h2>
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
