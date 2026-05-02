@extends('admin.layouts.app')

@section('title', $project->title)

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-2xl md:text-h1 text-slate-900">{{ $project->title }}</h1>
                <p class="font-body-lg text-body-lg text-slate-500 mt-2">عرض تفاصيل المشروع</p>
            </div>
            <div class="flex flex-wrap items-center gap-2 md:gap-3">
                <a href="{{ route('projects.show', $project->slug) }}" target="_blank"
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm md:text-base">
                    <span class="material-symbols-outlined text-lg md:text-xl" data-icon="open_in_new">open_in_new</span>
                    <span>عرض</span>
                </a>
                <a href="{{ route('admin.projects.edit', $project->id) }}" 
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-sm md:text-base">
                    <span class="material-symbols-outlined text-lg md:text-xl" data-icon="edit">edit</span>
                    <span>تعديل</span>
                </a>
                <a href="{{ route('admin.projects') }}" 
                   class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 rounded-lg hover:bg-slate-200 transition-colors text-sm md:text-base">
                    <span class="material-symbols-outlined text-lg md:text-xl" data-icon="arrow_back">arrow_back</span>
                    <span>العودة</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Project Info Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 md:p-8 mb-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <div>
                    <h3 class="font-h2 text-h2 text-slate-900 mb-4">وصف المشروع</h3>
                    <div class="prose max-w-none text-slate-600">
                        {!! nl2br(e($project->full_description)) !!}
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">link</span>
                            الروابط
                        </h4>
                        <div class="space-y-3">
                            <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center justify-between p-3 bg-white rounded-lg border border-slate-200 hover:border-primary transition-colors group">
                                <span class="text-slate-600 group-hover:text-primary transition-colors">معاينة مباشرة</span>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">open_in_new</span>
                            </a>
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="flex items-center justify-between p-3 bg-white rounded-lg border border-slate-200 hover:border-primary transition-colors group">
                                    <span class="text-slate-600 group-hover:text-primary transition-colors">كود المصدر (GitHub)</span>
                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">code</span>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="p-6 bg-slate-50 rounded-xl border border-slate-100">
                        <h4 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">construction</span>
                            التقنيات المستخدمة
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies as $tech)
                                <span class="px-3 py-1 bg-white border border-slate-200 text-slate-700 rounded-full text-sm">
                                    {{ $tech->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Cover Image -->
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100">
                    <h4 class="font-bold text-slate-900 mb-4">الصورة الرئيسية</h4>
                    @if($project->cover_image)
                        <img src="{{ Storage::url($project->cover_image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover rounded-lg shadow-sm">
                    @else
                        <div class="w-full h-48 bg-slate-200 rounded-lg flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-slate-400">image</span>
                        </div>
                    @endif
                </div>

                <!-- Status Card -->
                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">حالة المشروع</h4>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">الحالة</span>
                            @if($project->status == 'published')
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">منشور</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-bold">مسودة</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">مميز</span>
                            @if($project->is_featured)
                                <span class="text-indigo-600 flex items-center gap-1 font-bold">
                                    <span class="material-symbols-outlined text-sm">star</span>
                                    نعم
                                </span>
                            @else
                                <span class="text-slate-400">لا</span>
                            @endif
                        </div>
                        <hr class="border-slate-100">
                        <div class="flex flex-col gap-2">
                            @if($project->status == 'draft')
                                <button onclick="publishProject({{ $project->id }})" class="w-full py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors text-sm font-bold">نشر الآن</button>
                            @else
                                <button onclick="unpublishProject({{ $project->id }})" class="w-full py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition-colors text-sm font-bold">تحويل لمسودة</button>
                            @endif
                            <button onclick="toggleFeatured({{ $project->id }})" class="w-full py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition-colors text-sm font-bold">
                                {{ $project->is_featured ? 'إلغاء التميز' : 'تمييز المشروع' }}
                            </button>
                            <button onclick="deleteProject({{ $project->id }})" class="w-full py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm font-bold">حذف المشروع</button>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                    <h4 class="font-bold text-slate-900 mb-4">معلومات إضافية</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">الرابط المخصص</span>
                            <span class="text-slate-900 font-mono text-xs">{{ $project->slug }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">عدد الصور</span>
                            <span class="text-slate-900">{{ $project->images->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">عدد التقنيات</span>
                            <span class="text-slate-900">{{ $project->technologies->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">تاريخ الإنشاء</span>
                            <span class="text-slate-900">{{ $project->created_at->format('Y-m-d') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery -->
    @if($project->images->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 md:p-8">
            <h3 class="font-h2 text-h2 text-slate-900 mb-6">معرض الصور</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($project->images as $image)
                    <div class="relative group">
                        <img src="{{ Storage::url($image->image_path) }}" 
                             alt="Project image {{ $image->order_index + 1 }}" 
                             class="w-full h-32 object-cover rounded-lg cursor-pointer hover:opacity-90 transition-opacity"
                             onclick="openImageModal('{{ Storage::url($image->image_path) }}')">
                        <div class="absolute top-2 right-2 bg-slate-900 bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                            {{ $image->order_index + 1 }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" 
                class="absolute top-4 right-4 bg-white text-slate-900 rounded-full p-2 hover:bg-slate-100 transition-colors z-10">
            <span class="material-symbols-outlined">close</span>
        </button>
        <img id="modalImage" src="" alt="Full size image" class="max-w-full max-h-full rounded-lg">
    </div>
</div>

@push('scripts')
<script>
function publishProject(id) {
    if (confirm('هل أنت متأكد من نشر هذا المشروع؟')) {
        fetch(`/admin/projects/${id}/publish`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess(data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError('حدث خطأ ما. يرجى المحاولة مرة أخرى.');
        });
    }
}

function unpublishProject(id) {
    if (confirm('هل أنت متأكد من تحويل هذا المشروع إلى مسودة؟')) {
        fetch(`/admin/projects/${id}/unpublish`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess(data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError('حدث خطأ ما. يرجى المحاولة مرة أخرى.');
        });
    }
}

function toggleFeatured(id) {
    fetch(`/admin/projects/${id}/toggle-featured`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccess(data.message);
            setTimeout(() => location.reload(), 1500);
        } else {
            showError(data.message);
        }
    })
    .catch(error => {
        showError('حدث خطأ ما. يرجى المحاولة مرة أخرى.');
    });
}

function deleteProject(id) {
    if (confirm('هل أنت متأكد من حذف هذا المشروع؟ هذا الإجراء لا يمكن التراجع عنه.')) {
        fetch(`/admin/projects/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess(data.message);
                setTimeout(() => {
                    window.location.href = '{{ route('admin.projects') }}';
                }, 1500);
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            showError('حدث خطأ ما. يرجى المحاولة مرة أخرى.');
        });
    }
}

function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Close modal on background click
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});
</script>
@endpush
@endsection
