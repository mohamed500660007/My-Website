<!-- Toaster Container -->
<div id="toaster-container" class="fixed top-4 right-4 z-50 space-y-2 pointer-events-none">
    <!-- Toast messages will be inserted here -->
</div>

<!-- Toaster Styles -->
@once
@push('styles')
<style>
/* Toast Animations */
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}

.toast-enter {
    animation: slideIn 0.3s ease-out;
}

.toast-exit {
    animation: slideOut 0.3s ease-out;
}

.toast-fade-enter {
    animation: fadeIn 0.3s ease-out;
}

.toast-fade-exit {
    animation: fadeOut 0.3s ease-out;
}

/* RTL Support */
[dir="rtl"] #toaster-container {
    left: 4rem;
    right: auto;
}

[dir="rtl"] .toast-enter {
    animation: slideInRTL 0.3s ease-out;
}

[dir="rtl"] .toast-exit {
    animation: slideOutRTL 0.3s ease-out;
}

@keyframes slideInRTL {
    from {
        transform: translateX(-100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRTL {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(-100%);
        opacity: 0;
    }
}

/* Toast Progress Bar */
.toast-progress {
    animation: progress 5s linear forwards;
}

@keyframes progress {
    from {
        width: 100%;
    }
    to {
        width: 0%;
    }
}

/* Mobile Responsive */
@media (max-width: 640px) {
    #toaster-container {
        top: 1rem;
        right: 1rem;
        left: 1rem;
    }
    
    .toast {
        width: 100%;
        max-width: none;
    }
}
</style>
@endpush
@endonce

<!-- Toaster JavaScript -->
@once
@push('scripts')
<script>
class Toaster {
    constructor() {
        this.container = document.getElementById('toaster-container');
        this.toasts = new Map();
        this.toastId = 0;
    }

    show(message, type = 'info', options = {}) {
        const id = ++this.toastId;
        const toast = this.createToast(id, message, type, options);
        
        this.container.appendChild(toast);
        this.toasts.set(id, toast);

        // Trigger enter animation
        requestAnimationFrame(() => {
            toast.classList.add('toast-enter');
        });

        // Auto remove after duration
        const duration = options.duration || 5000;
        setTimeout(() => this.remove(id), duration);

        return id;
    }

    success(message, options = {}) {
        return this.show(message, 'success', options);
    }

    error(message, options = {}) {
        return this.show(message, 'error', options);
    }

    warning(message, options = {}) {
        return this.show(message, 'warning', options);
    }

    info(message, options = {}) {
        return this.show(message, 'info', options);
    }

    createToast(id, message, type, options) {
        const toast = document.createElement('div');
        toast.className = `toast pointer-events-auto flex items-start gap-3 p-4 rounded-lg shadow-lg backdrop-blur-sm max-w-md min-w-[300px] ${this.getTypeClasses(type)}`;
        toast.dataset.toastId = id;

        const icon = this.getIcon(type);
        const hasProgress = options.showProgress !== false;

        toast.innerHTML = `
            <div class="flex-shrink-0">
                ${icon}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium ${this.getTextClasses(type)}">${message}</p>
                ${options.description ? `<p class="text-sm mt-1 ${this.getSubtextClasses(type)}">${options.description}</p>` : ''}
            </div>
            <div class="flex flex-col gap-2">
                ${options.closable !== false ? `
                    <button onclick="toaster.remove(${id})" class="flex-shrink-0 p-1 rounded-md hover:bg-black/10 dark:hover:bg-white/10 transition-colors">
                        <svg class="w-4 h-4 ${this.getIconClasses(type)}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                ` : ''}
                ${hasProgress ? '<div class="toast-progress h-1 bg-black/20 dark:bg-white/20 rounded-full overflow-hidden"><div class="h-full bg-current rounded-full"></div></div>' : ''}
            </div>
        `;

        return toast;
    }

    getTypeClasses(type) {
        const classes = {
            success: 'bg-emerald-50 dark:bg-emerald-900/50 text-emerald-900 dark:text-emerald-100 border border-emerald-200 dark:border-emerald-800',
            error: 'bg-red-50 dark:bg-red-900/50 text-red-900 dark:text-red-100 border border-red-200 dark:border-red-800',
            warning: 'bg-amber-50 dark:bg-amber-900/50 text-amber-900 dark:text-amber-100 border border-amber-200 dark:border-amber-800',
            info: 'bg-blue-50 dark:bg-blue-900/50 text-blue-900 dark:text-blue-100 border border-blue-200 dark:border-blue-800'
        };
        return classes[type] || classes.info;
    }

    getTextClasses(type) {
        const classes = {
            success: 'text-emerald-900 dark:text-emerald-100',
            error: 'text-red-900 dark:text-red-100',
            warning: 'text-amber-900 dark:text-amber-100',
            info: 'text-blue-900 dark:text-blue-100'
        };
        return classes[type] || classes.info;
    }

    getSubtextClasses(type) {
        const classes = {
            success: 'text-emerald-700 dark:text-emerald-200',
            error: 'text-red-700 dark:text-red-200',
            warning: 'text-amber-700 dark:text-amber-200',
            info: 'text-blue-700 dark:text-blue-200'
        };
        return classes[type] || classes.info;
    }

    getIconClasses(type) {
        const classes = {
            success: 'text-emerald-600 dark:text-emerald-400',
            error: 'text-red-600 dark:text-red-400',
            warning: 'text-amber-600 dark:text-amber-400',
            info: 'text-blue-600 dark:text-blue-400'
        };
        return classes[type] || classes.info;
    }

    getIcon(type) {
        const icons = {
            success: `<svg class="w-5 h-5 ${this.getIconClasses(type)}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`,
            error: `<svg class="w-5 h-5 ${this.getIconClasses(type)}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`,
            warning: `<svg class="w-5 h-5 ${this.getIconClasses(type)}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>`,
            info: `<svg class="w-5 h-5 ${this.getIconClasses(type)}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>`
        };
        return icons[type] || icons.info;
    }

    remove(id) {
        const toast = this.toasts.get(id);
        if (!toast) return;

        toast.classList.remove('toast-enter');
        toast.classList.add('toast-exit');

        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
            this.toasts.delete(id);
        }, 300);
    }

    clear() {
        this.toasts.forEach((toast, id) => this.remove(id));
    }

    // Static methods for easy access
    static success(message, options = {}) {
        return window.toaster.success(message, options);
    }

    static error(message, options = {}) {
        return window.toaster.error(message, options);
    }

    static warning(message, options = {}) {
        return window.toaster.warning(message, options);
    }

    static info(message, options = {}) {
        return window.toaster.info(message, options);
    }

    static clear() {
        return window.toaster.clear();
    }
}

// Initialize global toaster instance
window.toaster = new Toaster();

// Global helper functions
window.showToast = (message, type, options) => window.toaster.show(message, type, options);
window.showSuccess = (message, options) => window.toaster.success(message, options);
window.showError = (message, options) => window.toaster.error(message, options);
window.showWarning = (message, options) => window.toaster.warning(message, options);
window.showInfo = (message, options) => window.toaster.info(message, options);
</script>
@endpush
@endonce

<!-- Include toaster component in layout -->
@include('components.toaster')
