<button
    x-data="{ isDark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
    @toggle-dark.window="isDark = !isDark"
    @click="$dispatch('toggle-dark')"
    class="p-2 rounded-lg bg-secondary text-foreground hover:bg-secondary/80 transition-all"
    :aria-label="isDark ? 'التبديل للوضع الفاتح' : 'التبديل للوضع الداكن'"
>
    <i x-show="!isDark" data-lucide="moon" class="w-5 h-5"></i>
    <i x-show="isDark" data-lucide="sun" class="w-5 h-5"></i>
</button>
