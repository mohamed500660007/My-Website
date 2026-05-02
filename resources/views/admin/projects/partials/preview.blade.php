<div class="space-y-8">
    <!-- Header with Image -->
    <div class="relative h-64 md:h-80 rounded-2xl overflow-hidden shadow-lg">
        @if($project->cover_image)
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                <span class="material-symbols-outlined text-slate-400 text-6xl">web</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent flex items-end p-8">
            <div>
                <h2 class="text-3xl font-bold text-white mb-2">{{ $project->title }}</h2>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-white/20 backdrop-blur-md text-white text-xs font-semibold rounded-full border border-white/30 uppercase tracking-wider">
                        {{ $project->status }}
                    </span>
                    @if($project->is_featured)
                        <span class="px-3 py-1 bg-amber-500 text-white text-xs font-semibold rounded-full shadow-lg">
                            MEMBER FEATURED
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-2 space-y-6">
            <section>
                <h4 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">description</span>
                    الوصف المختصر
                </h4>
                <p class="text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-xl border border-slate-100">
                    {{ $project->short_description }}
                </p>
            </section>

            <section>
                <h4 class="text-lg font-bold text-slate-900 mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">article</span>
                    الوصف التفصيلي
                </h4>
                <div class="prose prose-slate max-w-none text-slate-600 bg-white p-4 rounded-xl">
                    {!! $project->full_description !!}
                </div>
            </section>
        </div>

        <div class="space-y-6">
            @if($project->images->count() > 0)
            <section class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <h4 class="text-md font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">gallery_thumbnail</span>
                    معرض الصور
                </h4>
                <div class="grid grid-cols-2 gap-3">
                    @foreach($project->images as $image)
                        <div class="aspect-square rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        </div>
                    @endforeach
                </div>
            </section>
            @endif

            <section class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <h4 class="text-md font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">stack</span>
                    التقنيات المستخدمة
                </h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->technologies as $tech)
                        <span class="px-3 py-1 bg-white text-primary border border-primary/20 rounded-lg text-sm font-medium shadow-sm">
                            {{ $tech->name }}
                        </span>
                    @endforeach
                </div>
            </section>

            <section class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <h4 class="text-md font-bold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">link</span>
                    روابط المشروع
                </h4>
                <div class="space-y-3">
                    <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center justify-between p-3 bg-white hover:bg-primary hover:text-white rounded-xl transition-all shadow-sm group">
                        <span class="font-medium">عرض الديمو</span>
                        <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">open_in_new</span>
                    </a>
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="flex items-center justify-between p-3 bg-white hover:bg-slate-900 hover:text-white rounded-xl transition-all shadow-sm group">
                            <span class="font-medium">المستودع (Github)</span>
                            <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">code</span>
                        </a>
                    @endif
                </div>
            </section>
        </div>
    </div>
</div>
