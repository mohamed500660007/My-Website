<div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-2">
        <span class="material-symbols-outlined text-primary bg-primary/10 p-2 rounded-lg text-xl md:text-2xl">folder</span>
    </div>
    <p class="text-xl md:text-2xl font-bold text-slate-900">{{ $stats['total'] ?? 0 }}</p>
    <p class="text-xs md:text-sm text-slate-500">إجمالي المشاريع</p>
</div>

<div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-2">
        <span class="material-symbols-outlined text-emerald-600 bg-emerald-100 p-2 rounded-lg text-xl md:text-2xl">check_circle</span>
    </div>
    <p class="text-xl md:text-2xl font-bold text-slate-900">{{ $stats['published'] ?? 0 }}</p>
    <p class="text-xs md:text-sm text-slate-500">منشورة</p>
</div>

<div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-2">
        <span class="material-symbols-outlined text-orange-600 bg-orange-100 p-2 rounded-lg text-xl md:text-2xl">pending</span>
    </div>
    <p class="text-xl md:text-2xl font-bold text-slate-900">{{ $stats['draft'] ?? 0 }}</p>
    <p class="text-xs md:text-sm text-slate-500">مسودات</p>
</div>

<div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="flex items-center justify-between mb-2">
        <span class="material-symbols-outlined text-indigo-600 bg-indigo-100 p-2 rounded-lg text-xl md:text-2xl">star</span>
    </div>
    <p class="text-xl md:text-2xl font-bold text-slate-900">{{ $stats['featured'] ?? 0 }}</p>
    <p class="text-xs md:text-sm text-slate-500">مميزة</p>
</div>
