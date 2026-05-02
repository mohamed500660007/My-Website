@forelse($services as $service)
<tr class="hover:bg-slate-50 transition-colors">
    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-slate-500 font-medium">
        #{{ $service->id }}
    </td>
    <td class="px-6 py-4 text-right">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-indigo-50 rounded-lg overflow-hidden flex items-center justify-center">
                <span class="material-symbols-outlined text-indigo-600 text-2xl">{{ $service->icon }}</span>
            </div>
            <div>
                <p class="font-semibold text-slate-900">{{ $service->title }}</p>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 text-right">
        <p class="text-sm text-slate-500 line-clamp-2 max-w-xs">{{ $service->description }}</p>
    </td>
    <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-slate-500">
        {{ $service->order_index ?? '-' }}
    </td>
    <td class="px-6 py-4 text-center">
        <div class="relative inline-block text-right dropdown-wrapper">
            <button type="button" onclick="
                // Close all other dropdowns
                document.querySelectorAll('.dropdown-wrapper > div.absolute').forEach(el => {
                    if(el !== this.nextElementSibling) el.classList.add('hidden');
                });
                this.nextElementSibling.classList.toggle('hidden');
            " class="inline-flex items-center justify-between w-full text-xs font-semibold px-3 py-1.5 rounded-full border border-slate-200 shadow-sm focus:outline-none transition-colors {{ $service->status == 'active' ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-slate-50 text-slate-700 hover:bg-slate-100' }}">
                <span>{{ $service->status == 'active' ? 'نشط' : 'غير نشط' }}</span>
                <span class="material-symbols-outlined text-[14px] mr-1">expand_more</span>
            </button>
            
            <div class="hidden absolute right-0 z-50 mt-1 w-28 origin-top-right rounded-xl bg-white shadow-lg border border-slate-100 focus:outline-none overflow-hidden">
                <div class="py-1">
                    <button type="button" onclick="toggleStatus({{ $service->id }}, 'active'); this.closest('.absolute').classList.add('hidden')" class="flex items-center gap-2 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 px-4 py-2 text-sm w-full text-right font-medium transition-colors">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        نشط
                    </button>
                    <button type="button" onclick="toggleStatus({{ $service->id }}, 'inactive'); this.closest('.absolute').classList.add('hidden')" class="flex items-center gap-2 text-slate-600 hover:bg-slate-50 hover:text-slate-900 px-4 py-2 text-sm w-full text-right font-medium transition-colors">
                        <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                        غير نشط
                    </button>
                </div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 text-left whitespace-nowrap">
        <div class="flex items-center gap-2 justify-end relative z-10">
            <a href="{{ route('admin.services.edit', $service->id) }}" class="inline-flex p-2 text-slate-500 hover:text-indigo-600 transition-colors" title="تعديل">
                <span class="material-symbols-outlined pointer-events-none">edit</span>
            </a>
            <button type="button" onclick="confirmDelete({{ $service->id }})" class="inline-flex p-2 text-slate-500 hover:text-red-600 transition-colors" title="حذف">
                <span class="material-symbols-outlined pointer-events-none">delete</span>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="px-6 py-12 text-center text-slate-500">
        <div class="flex flex-col items-center justify-center">
            <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">design_services</span>
            <p>لا توجد خدمات مضافة حتى الآن.</p>
            <a href="{{ route('admin.services.create') }}" class="mt-4 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors font-medium">
                إضافة الخدمة الأولى
            </a>
        </div>
    </td>
</tr>
@endforelse
