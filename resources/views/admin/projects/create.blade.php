@extends('admin.layouts.app')

@section('title', 'إنشاء مشروع جديد')

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-2xl md:text-h1 text-slate-900">إنشاء مشروع جديد</h1>
                <p class="font-body-lg text-body-lg text-slate-500 mt-2">أضف مشروعاً جديداً إلى معرض أعمالك</p>
            </div>
            <a href="{{ route('admin.projects') }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors w-full sm:w-auto">
                <span class="material-symbols-outlined" data-icon="arrow_back">arrow_back</span>
                <span>العودة</span>
            </a>
        </div>
    </div>

    <!-- Form -->
    <form id="projectForm" class="space-y-8" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content Column -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 md:p-8">
                    <h3 class="font-h2 text-xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        تفاصيل المشروع
                    </h3>
                    
                    @include('admin.projects.partials.dynamic_fields', [
                        'fields' => array_filter($fields, fn($f) => !in_array($f['name'], ['cover_image', 'status', 'is_featured']))
                    ])

                    <!-- Gallery Images (Keep separate as it handles multiple) -->
                    <div class="mt-8">
                        <h4 class="text-sm font-bold text-slate-700 mb-4">معرض الصور الإضافية</h4>
                        <div class="border-2 border-dashed border-slate-200 rounded-xl p-8 text-center hover:border-primary hover:bg-primary/5 transition-all group">
                            <input type="file" name="images[]" id="galleryImages" accept="image/*" multiple class="hidden">
                            <label for="galleryImages" class="cursor-pointer">
                                <span class="material-symbols-outlined text-5xl text-slate-400 group-hover:scale-110 transition-transform">add_a_photo</span>
                                <p class="text-slate-600 mt-2 font-medium">انقر لرفع صور المعرض</p>
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
                    @include('admin.projects.partials.dynamic_fields', [
                        'fields' => array_intersect_key($fields, ['cover_image' => ''])
                    ])
                </div>

                <!-- Status & Featured -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">settings</span>
                        النشر والإعدادات
                    </h3>
                    @include('admin.projects.partials.dynamic_fields', [
                        'fields' => array_intersect_key($fields, ['status' => '', 'is_featured' => ''])
                    ])

                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <button type="submit" id="submitBtn"
                                class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 font-bold">
                            <span class="material-symbols-outlined">save</span>
                            <span>حفظ المشروع</span>
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
                        <div class="flex flex-wrap gap-2" id="technologyTags"></div>
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

<!-- Notification Container -->
<div id="notification-container" class="fixed bottom-8 left-8 z-[100] flex flex-col gap-3"></div>

@push('scripts')
<script>
let technologies = [];

function addTechnology() {
    const input = document.getElementById('technologyInput');
    const value = input.value.trim();
    if (value && !technologies.includes(value)) {
        technologies.push(value);
        updateTechnologyTags();
        input.value = '';
    }
}

function removeTechnology(index) {
    technologies.splice(index, 1);
    updateTechnologyTags();
}

function updateTechnologyTags() {
    const container = document.getElementById('technologyTags');
    container.innerHTML = technologies.map((tech, index) => `
        <span class="inline-flex items-center gap-1 px-3 py-1 bg-primary/10 text-primary rounded-full text-sm font-bold">
            ${tech}
            <button type="button" onclick="removeTechnology(${index})" class="hover:text-primary/80 flex">
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
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl shadow-md"><p class="text-xs text-primary font-bold mt-2">تغيير الصورة</p>`;
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
    btn.innerHTML = '<span class="animate-spin material-symbols-outlined">sync</span> جارٍ الحفظ...';

    const formData = new FormData(this);
    technologies.forEach(tech => formData.append('technologies[]', tech));
    
    try {
        const response = await fetch('{{ route('admin.projects.store') }}', {
            method: 'POST',
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
