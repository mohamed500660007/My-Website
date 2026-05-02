@extends('admin.layouts.app')

@section('title', 'إدارة الخدمات')

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="font-h1 text-2xl md:text-h1 text-slate-900">الخدمات</h1>
                <p class="font-body-lg text-body-lg text-slate-500 mt-2">إدارة وعرض جميع الخدمات التي تقدمها</p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors w-full sm:w-auto shadow-lg shadow-primary/20">
                <span class="material-symbols-outlined" data-icon="add">add</span>
                <span >إضافة خدمة جديدة</span>
            </a>
        </div>
    </div>

    <!-- Services Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 relative min-h-[400px]">
        <!-- Loading Overlay -->
        <div id="loading-overlay" class="absolute inset-0 bg-white/60 backdrop-blur-[1px] z-10 flex items-center justify-center hidden rounded-xl">
            <div class="animate-spin rounded-full h-12 w-12 border-4 border-primary border-t-transparent"></div>
        </div>

        <div class="overflow-x-auto rounded-xl">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700 w-[60px]">#</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">الخدمة</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">الوصف</th>
                        <th class="px-6 py-4 text-right text-sm font-semibold text-slate-700">الترتيب</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-slate-700">الحالة</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700 w-[120px]">إجراءات</th>
                    </tr>
                </thead>
                <tbody id="services-table-body" class="divide-y divide-slate-200">
                    @include('admin.services.partials.service_list', ['services' => $services])
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div id="success-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeSuccessModal()"></div>
    <div id="success-modal-panel" class="bg-white rounded-2xl shadow-2xl max-w-md w-full relative z-10 overflow-hidden opacity-0 translate-y-4 scale-95 transition-all duration-300">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-4xl">check_circle</span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">تم بنجاح!</h3>
            <p id="success-modal-message" class="text-slate-500 mb-6"></p>
            <button onclick="closeSuccessModal()" class="w-full px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-colors font-semibold">موافق</button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4">
    <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div id="delete-modal-panel" class="bg-white rounded-2xl shadow-2xl max-w-md w-full relative z-10 overflow-hidden opacity-0 translate-y-4 scale-95 transition-all duration-300">
        <div class="p-6 text-center">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-4xl">delete_forever</span>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2">تأكيد الحذف</h3>
            <p class="text-slate-500 mb-6">هل أنت متأكد من حذف هذه الخدمة؟ لا يمكن التراجع عن هذا الإجراء.</p>
            <div class="flex gap-3">
                <button id="confirm-delete-btn" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition-colors font-semibold">نعم، احذف</button>
                <button type="button" onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-slate-100 text-slate-700 rounded-xl hover:bg-slate-200 transition-colors font-semibold">إلغاء</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let serviceToDelete = null;

    function confirmDelete(id) {
        serviceToDelete = id;
        const modal = document.getElementById('delete-modal');
        const panel = document.getElementById('delete-modal-panel');

        modal.classList.remove('hidden');

        // Trigger animations
        setTimeout(() => {
            panel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        const panel = document.getElementById('delete-modal-panel');

        panel.classList.add('opacity-0', 'translate-y-4', 'scale-95');

        setTimeout(() => {
            modal.classList.add('hidden');
            serviceToDelete = null;
        }, 300);
    }

    function openSuccessModal(message) {
        document.getElementById('success-modal-message').innerText = message;
        const modal = document.getElementById('success-modal');
        const panel = document.getElementById('success-modal-panel');
        modal.classList.remove('hidden');
        setTimeout(() => {
            panel.classList.remove('opacity-0', 'translate-y-4', 'scale-95');
        }, 10);
    }

    function closeSuccessModal() {
        const modal = document.getElementById('success-modal');
        const panel = document.getElementById('success-modal-panel');
        panel.classList.add('opacity-0', 'translate-y-4', 'scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Perform Delete
    document.getElementById('confirm-delete-btn').addEventListener('click', async function() {
        if (!serviceToDelete) return;

        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-2 border-white border-t-transparent mx-auto"></div>';
        btn.disabled = true;

        try {
            const response = await fetch(`/admin/services/${serviceToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                closeDeleteModal();
                openSuccessModal(data.message);
                // Refresh table
                refreshTable();
            } else {
                showError(data.message || 'حدث خطأ أثناء الحذف');
            }
        } catch (error) {
            showError('حدث خطأ في الاتصال');
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    });

    async function toggleStatus(id, newStatus) {
        try {
            const response = await fetch(`/admin/services/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            });

            const data = await response.json();

            if (data.success) {
                openSuccessModal(data.message);
                refreshTable();
            } else {
                showError(data.message || 'حدث خطأ أثناء تحديث الحالة');
                refreshTable(); // Revert toggle visually
            }
        } catch (error) {
            showError('حدث خطأ في الاتصال');
            refreshTable();
        }
    }

    async function refreshTable() {
        const overlay = document.getElementById('loading-overlay');
        overlay.classList.remove('hidden');

        try {
            const response = await fetch(window.location.href, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();

            document.getElementById('services-table-body').innerHTML = data.html;
        } catch (error) {
            showError('فشل تحديث الجدول');
        } finally {
            overlay.classList.add('hidden');
        }
    }
</script>
@endpush