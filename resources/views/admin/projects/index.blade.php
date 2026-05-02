@extends('admin.layouts.app')

@section('title', 'إدارة المشاريع')

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-2xl md:text-h1 text-slate-900">المشاريع</h1>
                <p class="font-body-lg text-body-lg text-slate-500 mt-2">إدارة وعرض جميع مشاريع المحفظة</p>
            </div>
            <a href="{{ route('admin.projects.create') }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors w-full sm:w-auto shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                <span >إضافة مشروع جديد</span>
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div id="stats-container" class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        @include('admin.projects.partials.stats', ['stats' => $stats])
    </div>

    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <form id="filter-form" class="flex flex-col lg:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" name="search" id="search-input" placeholder="البحث عن مشروع بالاسم أو الوصف..." class="w-full px-4 py-2 pr-10 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400" data-icon="search">search</span>
                </div>
            </div>
            <div class="flex flex-wrap gap-4">
                <select name="status" id="status-filter" class="px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent min-w-[150px]">
                    <option value="">جميع الحالات</option>
                    <option value="published">منشور</option>
                    <option value="draft">مسودة</option>
                </select>
                
                <select name="technology" id="tech-filter" class="px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent min-w-[150px]">
                    <option value="">جميع التقنيات</option>
                    @foreach($technologies as $tech)
                        <option value="{{ $tech->name }}">{{ $tech->name }}</option>
                    @endforeach
                </select>

                <button type="button" onclick="resetFilters()" class="px-4 py-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">restart_alt</span>
                    <span>إعادة تعيين</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Projects Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden relative min-h-[400px]">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="absolute inset-0 bg-white/60 backdrop-blur-[1px] z-10 flex items-center justify-center hidden">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">المشروع</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">الحالة</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">التقنيات</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">التاريخ</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="projects-table-body" class="divide-y divide-slate-200">
                    @include('admin.projects.partials.project_list', ['projects' => $projects])
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="px-6 py-4 border-t border-slate-200">
            {{ $projects->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full relative z-10 overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-4xl">delete_forever</span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">تأكيد الحذف</h3>
            <p class="text-slate-500 mb-6">هل أنت متأكد من حذف المشروع "<span id="delete-project-title" class="font-semibold text-slate-700"></span>"؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="flex gap-3">
                <button onclick="performDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-semibold">نعم، احذف</button>
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors font-semibold">إلغاء</button>
            </div>
        </div>
    </div>
</div>

<!-- Project Preview Modal -->
<div id="preview-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closePreviewModal()"></div>
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full relative z-10 overflow-hidden max-h-[90vh] flex flex-col animate-in fade-in slide-in-from-bottom-8 duration-300">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-slate-50">
            <h3 class="text-lg font-bold text-slate-900">معاينة المشروع</h3>
            <button onclick="closePreviewModal()" class="p-2 text-slate-500 hover:text-slate-700 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div id="preview-content" class="overflow-y-auto p-6">
            <!-- Content loaded via AJAX -->
            <div class="flex items-center justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
            </div>
        </div>
    </div>
</div>

<!-- Notification Toast Template -->
<div id="notification-container" class="fixed bottom-8 left-8 z-[100] flex flex-col gap-3"></div>

@push('scripts')
<script>
    let currentDeleteId = null;

    // --- AJAX Filtering Logic ---
    const filterForm = document.getElementById('filter-form');
    const searchInput = document.getElementById('search-input');
    const statusFilter = document.getElementById('status-filter');
    const techFilter = document.getElementById('tech-filter');
    const tableBody = document.getElementById('projects-table-body');
    const loadingOverlay = document.getElementById('loading-overlay');

    let debounceTimer;
    
    function updateList() {
        loadingOverlay.classList.remove('hidden');
        const formData = new FormData(filterForm);
        const params = new URLSearchParams(formData);
        
        fetch(`{{ route('admin.projects') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            tableBody.innerHTML = data.html;
            document.getElementById('stats-container').innerHTML = data.stats_html || document.getElementById('stats-container').innerHTML;
            loadingOverlay.classList.add('hidden');
            // Update URL without reload
            window.history.pushState({}, '', `{{ route('admin.projects') }}?${params.toString()}`);
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('حدث خطأ أثناء تحميل البيانات', 'error');
            loadingOverlay.classList.add('hidden');
        });
    }

    searchInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(updateList, 500);
    });

    statusFilter.addEventListener('change', updateList);
    techFilter.addEventListener('change', updateList);

    function resetFilters() {
        filterForm.reset();
        updateList();
    }

    // --- Status Update Logic ---
    async function updateStatus(id, newStatus) {
        try {
            const response = await fetch(`/admin/projects/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            });
            
            const result = await response.json();
            if (result.success) {
                showNotification(result.message, 'success');
                // Refresh the row or select style
                const select = document.querySelector(`.project-row[data-id="${id}"] select`);
                if (select) {
                    select.className = `text-xs font-semibold px-2 py-1 rounded-full border-none focus:ring-0 cursor-pointer ${newStatus === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700'}`;
                }
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('حدث خطأ أثناء تحديث الحالة', 'error');
        }
    }

    // --- Delete Logic ---
    function confirmDelete(id, title) {
        currentDeleteId = id;
        document.getElementById('delete-project-title').textContent = title;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        currentDeleteId = null;
    }

    async function performDelete() {
        if (!currentDeleteId) return;
        
        try {
            const response = await fetch(`/admin/projects/${currentDeleteId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            
            const result = await response.json();
            if (result.success) {
                showNotification(result.message, 'success');
                closeDeleteModal();
                updateList();
            } else {
                showNotification(result.message, 'error');
            }
        } catch (error) {
            showNotification('حدث خطأ أثناء الحذف', 'error');
        }
    }

    // --- Preview Logic ---
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

    // --- Notification Logic ---
    function showNotification(message, type = 'success') {
        const container = document.getElementById('notification-container');
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
        const icon = type === 'success' ? 'check_circle' : 'error';
        
        toast.className = `${bgColor} text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3 animate-in slide-in-from-left duration-300 transform transition-all`;
        toast.innerHTML = `
            <span class="material-symbols-outlined">${icon}</span>
            <span class="font-semibold">${message}</span>
        `;
        
        container.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('opacity-0', '-translate-x-full');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
</script>
@endpush
@endsection
