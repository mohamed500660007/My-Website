@extends('admin.layouts.app')

@section('title', 'إضافة خدمة جديدة')

@section('content')
<div class="p-4 md:p-8 max-w-[1440px] mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">إضافة خدمة جديدة</h1>
            <p class="text-slate-500 text-sm mt-1">أدخل بيانات الخدمة الجديدة لعرضها في الموقع</p>
        </div>
        <a href="{{ route('admin.services') }}" class="px-4 py-2 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors text-sm font-medium">
            العودة للقائمة
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <form id="serviceForm" onsubmit="submitForm(event)" class="p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="space-y-2 md:col-span-2">
                    <label for="title" class="block text-sm font-bold text-slate-700">عنوان الخدمة <span class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <p class="text-xs text-red-500 hidden" id="error-title"></p>
                </div>

                <!-- Description -->
                <div class="space-y-2 md:col-span-2">
                    <label for="description" class="block text-sm font-bold text-slate-700">وصف الخدمة <span class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="4" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"></textarea>
                    <p class="text-xs text-red-500 hidden" id="error-description"></p>
                </div>

                <!-- Icon -->
                <div class="space-y-2">
                    <label for="icon" class="block text-sm font-bold text-slate-700">أيقونة الخدمة (Google Material Icons) <span class="text-red-500">*</span></label>
                    <input type="text" id="icon" name="icon" placeholder="مثال: code, web, design" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <p class="text-xs text-slate-500 mt-1">اكتب اسم الأيقونة من Material Symbols</p>
                    <p class="text-xs text-red-500 hidden" id="error-icon"></p>
                </div>

                <!-- Status -->
                <div class="space-y-2">
                    <label for="status" class="block text-sm font-bold text-slate-700">الحالة <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <option value="active">نشط</option>
                        <option value="inactive">غير نشط</option>
                    </select>
                    <p class="text-xs text-red-500 hidden" id="error-status"></p>
                </div>

                <!-- Order -->
                <div class="space-y-2">
                    <label for="order_index" class="block text-sm font-bold text-slate-700">ترتيب العرض</label>
                    <input type="number" id="order_index" name="order_index" placeholder="اختياري" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                    <p class="text-xs text-red-500 hidden" id="error-order_index"></p>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-slate-200 flex items-center justify-end gap-3">
                <button type="button" onclick="window.location.href='{{ route('admin.services') }}'" class="px-6 py-2.5 text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors font-medium">
                    إلغاء
                </button>
                <button type="submit" id="submitBtn" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm font-medium flex items-center justify-center min-w-[120px]">
                    <span>حفظ الخدمة</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    async function submitForm(e) {
        e.preventDefault();
        
        const form = e.target;
        const btn = document.getElementById('submitBtn');
        const originalText = btn.innerHTML;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        // Reset errors
        document.querySelectorAll('[id^="error-"]').forEach(el => {
            el.classList.add('hidden');
            el.innerText = '';
        });

        btn.innerHTML = '<div class="animate-spin rounded-full h-5 w-5 border-2 border-white border-t-transparent mx-auto"></div>';
        btn.disabled = true;

        try {
            const response = await fetch('{{ route('admin.services.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showSuccess(result.message);
                setTimeout(() => {
                    window.location.href = '{{ route('admin.services') }}';
                }, 1500);
            } else {
                if (result.errors) {
                    for (const [field, messages] of Object.entries(result.errors)) {
                        const errorEl = document.getElementById(`error-${field}`);
                        if (errorEl) {
                            errorEl.innerText = messages[0];
                            errorEl.classList.remove('hidden');
                        }
                    }
                    showError('يرجى تصحيح الأخطاء في النموذج');
                } else {
                    showError(result.message || 'حدث خطأ غير متوقع');
                }
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        } catch (error) {
            showError('حدث خطأ في الاتصال');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    }
</script>
@endpush