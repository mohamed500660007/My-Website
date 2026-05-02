@extends('admin.layouts.app')

@section('title', 'تعديل المشروع')

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-2xl md:text-h1 text-slate-900">تعديل المشروع</h1>
                <p class="font-body-lg text-body-lg text-slate-500 mt-2">تحديث معلومات المشروع: {{ $project->title }}</p>
            </div>
            <div class="flex items-center gap-2 md:gap-3">
                <button onclick="previewProject({{ $project->id }})" 
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors text-sm md:text-base font-medium">
                    <span class="material-symbols-outlined text-lg md:text-xl" data-icon="visibility">visibility</span>
                    <span>معاينة</span>
                </button>
                <a href="{{ route('admin.projects') }}" 
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors text-sm md:text-base font-medium">
                    <span class="material-symbols-outlined text-lg md:text-xl" data-icon="arrow_back">arrow_back</span>
                    <span>العودة</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form id="projectForm" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                    <h3 class="font-h2 text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        تفاصيل المشروع
                    </h3>

                    @foreach(array_filter($fields, fn($f) => !in_array($f['name'], ['cover_image', 'status', 'is_featured'])) as $name => $field)
                        @php $value = $project->$name; @endphp
                    @endforeach

                    <!-- Manual override to inject value into partial -->
                    @php
                        $filteredFields = array_filter($fields, fn($f) => !in_array($f['name'], ['cover_image', 'status', 'is_featured']));
                    @endphp
                    
                    @foreach($filteredFields as $name => $field)
                         <div class="mb-6">
                            <label class="block text-sm font-medium text-slate-700 mb-2">{{ $field['label'] }} {{ $field['required'] ? '*' : '' }}</label>
                            @if($field['type'] === 'textarea')
                                <textarea name="{{ $name }}" {{ $field['required'] ? 'required' : '' }} rows="3"
                                          class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                                          placeholder="أدخل {{ $field['label'] }}">{{ $project->$name }}</textarea>
                            @elseif($field['type'] === 'editor')
                                <textarea name="{{ $name }}" {{ $field['required'] ? 'required' : '' }} rows="8"
                                          class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all rich-editor"
                                          placeholder="أدخل {{ $field['label'] }}">{{ $project->$name }}</textarea>
                            @elseif($field['type'] === 'url')
                                <input type="url" name="{{ $name }}" value="{{ $project->$name }}" {{ $field['required'] ? 'required' : '' }}
                                       class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            @else
                                <input type="text" name="{{ $name }}" value="{{ $project->$name }}" {{ $field['required'] ? 'required' : '' }}
                                       class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            @endif
                         </div>
                    @endforeach

                    <!-- Gallery Images -->
                    <div class="mt-8 pt-8 border-t border-slate-100">
                        <div class="grid grid-cols-3 md:grid-cols-5 gap-4 mb-6" id="current-gallery">
                            @foreach($project->images as $image)
                                <div class="relative group aspect-square gallery-item" data-id="{{ $image->id }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-full h-full object-cover rounded-xl shadow-sm border border-slate-100">
                                    <div class="absolute inset-0 bg-slate-900/60 opacity-0 group-hover:opacity-100 transition-opacity rounded-xl flex flex-col items-center justify-center gap-2">
                                        <span class="text-white font-bold text-[10px]">ترتيب: {{ $image->order_index + 1 }}</span>
                                        <button type="button" onclick="markForDeletion({{ $image->id }}, this)" 
                                                class="p-1.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors shadow-lg">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </div>
                                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}" class="existing-image-input">
                                </div>
                            @endforeach
                        </div>
                        <div id="deleted-images-container"></div>
                        
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-primary hover:bg-primary/5 transition-all group">
                            <input type="file" name="images[]" id="galleryImages" accept="image/*" multiple class="hidden">
                            <label for="galleryImages" class="cursor-pointer">
                                <span class="material-symbols-outlined text-5xl text-slate-400 group-hover:scale-110 transition-transform">add_a_photo</span>
                                <p class="text-slate-600 mt-2 font-medium">رفع صور جديدة للمعرض</p>
                                <p class="text-xs text-slate-400">سيتم إضافة الصور المختارة إلى المعرض</p>
                            </label>
                        </div>
                        <div id="galleryPreview" class="grid grid-cols-3 md:grid-cols-5 gap-4 mt-6"></div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Cover Image -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">image</span>
                        صورة الغلاف
                    </h3>
                    <div class="border-2 border-dashed border-slate-200 rounded-xl p-6 text-center hover:border-primary hover:bg-primary/5 transition-all group relative">
                        <input type="file" name="cover_image" id="coverImage" accept="image/*" class="hidden file-input" data-preview="preview-cover">
                        <label for="coverImage" class="cursor-pointer">
                            <div id="preview-cover" class="flex flex-col items-center justify-center">
                                @if($project->cover_image)
                                    <img src="{{ asset('storage/' . $project->cover_image) }}" class="w-full h-32 object-cover rounded-xl shadow-md mb-2">
                                    <p class="text-xs text-primary font-bold">تغيير صورة الغلاف</p>
                                @else
                                    <span class="material-symbols-outlined text-4xl text-slate-400 group-hover:scale-110 transition-transform">cloud_upload</span>
                                    <p class="text-xs text-slate-500 mt-2">رفع الغلاف</p>
                                @endif
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Status & Featured -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">settings</span>
                        النشر والإعدادات
                    </h3>
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-slate-700 mb-2">الحالة</label>
                        <select name="status" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                            <option value="draft" {{ $project->status === 'draft' ? 'selected' : '' }}>مسودة</option>
                            <option value="published" {{ $project->status === 'published' ? 'selected' : '' }}>منشور</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100">
                        <span class="text-sm text-slate-600 font-medium">مشروع مميز</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_featured" value="1" {{ $project->is_featured ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-10 h-5 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary transition-all"></div>
                        </label>
                    </div>

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <button type="submit" id="submitBtn"
                                class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 font-bold">
                            <span class="material-symbols-outlined">update</span>
                            <span>تحديث المشروع</span>
                        </button>
                    </div>
                </div>

                <!-- Technologies -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">bolt</span>
                        التقنيات
                    </h3>
                    <div class="space-y-4">
                        <div class="flex flex-wrap gap-2" id="technologyTags">
                            @foreach($project->technologies as $tech)
                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-bold" data-name="{{ $tech->name }}">
                                    {{ $tech->name }}
                                    <button type="button" onclick="removeTechnology('{{ $tech->name }}')" class="hover:text-primary/80 flex">
                                        <span class="material-symbols-outlined text-base">close</span>
                                    </button>
                                </span>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <input type="text" id="technologyInput" 
                                   class="flex-1 px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                                   placeholder="أضف تقنية">
                            <button type="button" onclick="addTechnology()" 
                                    class="px-3 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition-colors text-sm">
                                <span class="material-symbols-outlined text-sm">add</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Preview Modal -->
<div id="preview-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closePreviewModal()"></div>
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative z-10 overflow-hidden max-h-[90vh] flex flex-col">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900">معاينة المشروع</h3>
            <button onclick="closePreviewModal()" class="p-2 text-slate-500 hover:text-slate-700 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div id="preview-content" class="overflow-y-auto p-6"></div>
    </div>
</div>

<!-- Notification Container -->
<div id="notification-container" class="fixed bottom-8 left-8 z-[100] flex flex-col gap-3"></div>

@push('scripts')
<script>
let technologies = @json($project->technologies->pluck('name'));

function addTechnology() {
    const input = document.getElementById('technologyInput');
    const value = input.value.trim();
    if (value && !technologies.includes(value)) {
        technologies.push(value);
        updateTechnologyTags();
        input.value = '';
    }
}

function removeTechnology(name) {
    technologies = technologies.filter(t => t !== name);
    updateTechnologyTags();
}

function updateTechnologyTags() {
    const container = document.getElementById('technologyTags');
    container.innerHTML = technologies.map((tech) => `
        <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-bold">
            ${tech}
            <button type="button" onclick="removeTechnology('${tech}')" class="hover:text-primary/80 flex">
                <span class="material-symbols-outlined text-base">close</span>
            </button>
        </span>
    `).join('');
}

// File preview handling
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function(e) {
        const previewId = this.dataset.preview;
        const preview = document.getElementById(previewId);
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl shadow-md mb-2"><p class="text-xs text-primary font-bold">تغيير الصورة</p>`;
            };
            reader.readAsDataURL(file);
        }
    });
});

// Gallery images preview
document.getElementById('galleryImages').addEventListener('change', function(e) {
    const preview = document.getElementById('galleryPreview');
    preview.innerHTML = '';
    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const div = document.createElement('div');
            div.className = 'relative group aspect-square';
            div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-xl shadow-sm border border-slate-200">`;
            preview.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
});

// Form submission
document.getElementById('projectForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Form submission started');
    
    const btn = document.getElementById('submitBtn');
    const originalContent = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-spin material-symbols-outlined">sync</span> جارٍ التحديث...';

    const formData = new FormData(this);
    technologies.forEach(tech => formData.append('technologies[]', tech));
    
    try {
        const response = await fetch('{{ route('admin.projects.update', $project->id) }}', {
            method: 'POST', // Laravel handles PUT via _method field in FormData
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        
        const result = await response.json();
        console.log('Response received:', result);

        if (response.ok && result.success) {
            showNotification(result.message, 'success');
            setTimeout(() => window.location.href = '{{ route('admin.projects') }}', 1500);
        } else {
            // Handle validation errors or server errors
            let errorMessage = result.message || 'حدث خطأ في البيانات المرسلة';
            if (result.errors) {
                errorMessage = Object.values(result.errors).flat().join('<br>');
            }
            showNotification(errorMessage, 'error');
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    } catch (error) {
        console.error('Submission error:', error);
        showNotification('حدث خطأ غير متوقع: ' + error.message, 'error');
        btn.disabled = false;
        btn.innerHTML = originalContent;
    }
});

function markForDeletion(id, btn) {
    const item = btn.closest('.gallery-item');
    const container = document.getElementById('deleted-images-container');
    
    // Add to deleted images list
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'deleted_images[]';
    input.value = id;
    container.appendChild(input);
    
    // Remove from UI
    item.remove();
}

async function previewProject(id) {
    const modal = document.getElementById('preview-modal');
    const content = document.getElementById('preview-content');
    modal.classList.remove('hidden');
    content.innerHTML = '<div class="flex items-center justify-center py-12"><div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div></div>';
    
    try {
        const response = await fetch(`/admin/projects/${id}?preview=1`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const html = await response.text();
        content.innerHTML = html;
    } catch (error) {
        content.innerHTML = '<p class="text-center text-red-500 py-12">حدث خطأ أثناء تحميل المعاينة</p>';
    }
}

function closePreviewModal() {
    document.getElementById('preview-modal').classList.add('hidden');
}

function showNotification(message, type = 'success') {
    const container = document.getElementById('notification-container');
    const toast = document.createElement('div');
    const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
    toast.className = `${bgColor} text-white px-6 py-3 rounded-xl shadow-xl flex items-center gap-3 animate-in slide-in-from-left duration-300 transform transition-all mb-3`;
    toast.innerHTML = `<span class="material-symbols-outlined">${type === 'success' ? 'check_circle' : 'error'}</span><span class="font-bold">${message}</span>`;
    container.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('opacity-0', '-translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}
</script>
@endpush
@endsection
