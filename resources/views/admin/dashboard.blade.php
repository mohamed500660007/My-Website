@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
<div class="p-8 max-w-[1440px] mx-auto">
    <!-- Welcome Header -->
    <div class="mb-8">
        <h1 class="font-h1 text-h1 text-slate-900">مرحباً بك مجدداً، أحمد!</h1>
        <p class="font-body-lg text-body-lg text-slate-500 mt-2">إليك ملخص سريع لأداء منصتك اليوم.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Stat Card 1 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="visibility">visibility</span>
                </div>
                <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+12.5%</span>
            </div>
            <h3 class="text-3xl font-black text-slate-900 mb-1">24.5K</h3>
            <p class="text-sm text-slate-500 font-tajawal">الزيارات هذا الشهر</p>
        </div>

        <!-- Stat Card 2 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="favorite">favorite</span>
                </div>
                <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">+5.2%</span>
            </div>
            <h3 class="text-3xl font-black text-slate-900 mb-1">1,245</h3>
            <p class="text-sm text-slate-500 font-tajawal">التفاعلات الإيجابية</p>
        </div>

        <!-- Stat Card 3 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="folder_special">folder_special</span>
                </div>
                <span class="text-sm font-bold text-slate-500 bg-slate-50 px-2 py-1 rounded-lg">ثابت</span>
            </div>
            <h3 class="text-3xl font-black text-slate-900 mb-1">12</h3>
            <p class="text-sm text-slate-500 font-tajawal">المشاريع النشطة</p>
        </div>

        <!-- Stat Card 4 -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined" data-icon="mail">mail</span>
                </div>
                <span class="text-sm font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">جديد</span>
            </div>
            <h3 class="text-3xl font-black text-slate-900 mb-1">48</h3>
            <p class="text-sm text-slate-500 font-tajawal">رسائل غير مقروءة</p>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Activity Chart -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-h2 text-xl text-slate-900 mb-1">نظرة عامة على الأداء</h2>
                    <p class="text-sm text-slate-500">إحصائيات الزيارات والمشاريع آخر 30 يوم</p>
                </div>
                <select class="border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>آخر 30 يوم</option>
                    <option>هذا العام</option>
                    <option>كل الوقت</option>
                </select>
            </div>
            <!-- Placeholder for Chart -->
            <div class="h-64 bg-slate-50 rounded-xl border border-slate-100 flex items-center justify-center">
                <div class="text-center">
                    <span class="material-symbols-outlined text-4xl text-slate-300 mb-2" data-icon="bar_chart">bar_chart</span>
                    <p class="text-sm text-slate-400">منطقة الرسم البياني</p>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h2 class="font-h2 text-xl text-slate-900 mb-6">أحدث النشاطات</h2>
            <div class="space-y-6">
                <!-- Activity Item 1 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm" data-icon="add_circle">add_circle</span>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium">تم إضافة مشروع جديد</p>
                        <p class="text-sm text-indigo-600 font-bold mb-1">تطبيق توصيل طلبات</p>
                        <p class="text-xs text-slate-500">منذ ساعتين</p>
                    </div>
                </div>

                <!-- Activity Item 2 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm" data-icon="mark_email_read">mark_email_read</span>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium">رسالة جديدة من عميل محتمل</p>
                        <p class="text-sm text-slate-600 line-clamp-1 mb-1">استفسار بخصوص تصميم موقع...</p>
                        <p class="text-xs text-slate-500">منذ 5 ساعات</p>
                    </div>
                </div>

                <!-- Activity Item 3 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-sm" data-icon="edit_document">edit_document</span>
                    </div>
                    <div>
                        <p class="text-sm text-slate-900 font-medium">تم تحديث المقال</p>
                        <p class="text-sm text-indigo-600 font-bold mb-1">أفضل ممارسات React</p>
                        <p class="text-xs text-slate-500">أمس، 14:30</p>
                    </div>
                </div>
            </div>
            
            <a href="#" class="inline-block mt-6 text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                عرض كل النشاطات &larr;
            </a>
        </div>
    </div>
</div>
@endsection
