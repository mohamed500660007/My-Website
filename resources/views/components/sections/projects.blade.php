@props(['projects' => []])

<section id="projects" class="py-32 bg-secondary/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mb-16 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <span class="font-ui text-sm text-primary font-semibold tracking-wide mb-3 block">أعمالي</span>
            <h2 class="font-heading text-4xl md:text-5xl font-bold mb-4">مشاريع مميزة</h2>
            <p class="font-subheading text-xl text-muted-foreground max-w-2xl mx-auto">
                شوف آخر المشاريع اللي اشتغلت عليها وحققت نتائج حقيقية
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $index => $project)
                <div
                    x-data="{ show: false }" x-intersect.once="show = true"
                    class="transition-all duration-500"
                    :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'"
                    style="transition-delay: {{ $index * 100 }}ms;"
                >
                    <a href="/projects/{{ $project['id'] }}">
                        <div class="group relative h-full bg-card border border-border rounded-2xl p-8 card-glow hover:shadow-2xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-2 overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 rounded-bl-[100px] -z-0"></div>

                            <div class="relative z-10">
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(array_slice($project['tags'], 0, 3) as $tag)
                                        <span class="font-ui px-3 py-1 text-xs rounded-full bg-primary/10 text-primary border border-primary/20">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>

                                <h3 class="font-heading text-2xl font-bold mb-3 group-hover:text-primary transition-colors">
                                    {{ $project['title'] }}
                                </h3>

                                <p class="font-body text-muted-foreground mb-6 leading-relaxed">
                                    {{ $project['hook'] }}
                                </p>

                                <div class="flex items-center gap-2 text-primary font-ui font-semibold">
                                    شوف التفاصيل
                                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-2 transition-transform"></i>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary/0 via-primary to-primary/0 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div x-data="{ show: false }" x-intersect.once="show = true"
            class="text-center mt-12 transition-all duration-600"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
            <a
                href="#contact"
                class="font-ui inline-flex items-center gap-2 px-8 py-4 bg-primary text-white rounded-2xl hover:bg-primary/90 transition-all hover:shadow-xl hover:shadow-primary/20 font-bold"
            >
                عندك مشروع؟ يلا نبدأ
                <i data-lucide="external-link" class="w-5 h-5"></i>
            </a>
        </div>
    </div>
</section>
