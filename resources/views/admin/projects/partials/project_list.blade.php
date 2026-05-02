@forelse($projects as $project)
<tr class="hover:bg-slate-50 transition-colors project-row" data-id="{{ $project->id }}">
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-slate-100 rounded-lg overflow-hidden flex items-center justify-center">
                @if($project->cover_image)
                    <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                @else
                    <span class="material-symbols-outlined text-slate-400" data-icon="web">web</span>
                @endif
            </div>
            <div>
                <p class="font-semibold text-slate-900">{{ $project->title }}</p>
                <p class="text-sm text-slate-500">{{ $project->slug }}</p>
            </div>
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="flex flex-col gap-1">
            <select onchange="updateStatus({{ $project->id }}, this.value)" class="text-xs font-semibold px-2 py-1 rounded-full border-none focus:ring-0 cursor-pointer {{ $project->status == 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                <option value="published" {{ $project->status == 'published' ? 'selected' : '' }}>منشور</option>
                <option value="draft" {{ $project->status == 'draft' ? 'selected' : '' }}>مسودة</option>
            </select>
            @if($project->is_featured)
                <span class="px-3 py-1 text-[10px] font-semibold bg-indigo-100 text-indigo-700 rounded-full w-fit">مميز</span>
            @endif
        </div>
    </td>
    <td class="px-6 py-4">
        <div class="flex flex-wrap gap-1">
            @foreach($project->technologies as $tech)
                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded">{{ $tech->name }}</span>
            @endforeach
        </div>
    </td>
    <td class="px-6 py-4 text-sm text-slate-500">
        {{ $project->created_at->format('d M Y') }}
    </td>
    <td class="px-6 py-4">
        <div class="flex items-center gap-2">
            <button onclick="previewProject({{ $project->id }})" class="p-2 text-slate-500 hover:text-primary transition-colors" title="معاينة">
                <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
            </button>
            <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-2 text-slate-500 hover:text-indigo-600 transition-colors" title="تعديل">
                <span class="material-symbols-outlined" data-icon="edit">edit</span>
            </a>
            <button onclick="confirmDelete({{ $project->id }}, '{{ $project->title }}')" class="p-2 text-slate-500 hover:text-red-600 transition-colors" title="حذف">
                <span class="material-symbols-outlined" data-icon="delete">delete</span>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
        <span class="material-symbols-outlined text-4xl mb-2" data-icon="folder_off">folder_off</span>
        <p>لا يوجد مشاريع تطابق بحثك</p>
    </td>
</tr>
@endforelse
