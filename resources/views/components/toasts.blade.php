<!-- Toast Container -->
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

@once
@push('styles')
<style>
/* Toast Styles */
.toast {
    min-width: 300px;
    max-width: 400px;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    display: flex;
    align-items: center;
    gap: 12px;
    font-family: 'Cairo', sans-serif;
    direction: rtl;
    animation: slideIn 0.3s ease-out;
}

.toast.removing {
    animation: slideOut 0.3s ease-out;
}

.toast-success {
    background-color: #10b981;
    color: white;
}

.toast-error {
    background-color: #ef4444;
    color: white;
}

.toast-warning {
    background-color: #f59e0b;
    color: white;
}

.toast-info {
    background-color: #3b82f6;
    color: white;
}

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

/* Mobile Responsive */
@media (max-width: 640px) {
    .toast {
        right: 16px;
        left: 16px;
        min-width: auto;
        max-width: none;
    }
}
</style>
@endpush
@endonce

@once
@push('scripts')
<script>
window.showToast = function(message, type = 'info', duration = 5000) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    const toastId = 'toast-' + Date.now();
    
    toast.id = toastId;
    toast.className = `toast toast-${type}`;
    
    const icons = {
        success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>',
        error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>',
        warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>',
        info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'
    };
    
    toast.innerHTML = `
        <div class="flex-shrink-0">
            ${icons[type] || icons.info}
        </div>
        <div class="flex-1 font-medium">
            ${message}
        </div>
        <button onclick="removeToast('${toastId}')" class="flex-shrink-0 p-1 hover:bg-white/20 rounded transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    container.appendChild(toast);
    
    // Auto remove
    setTimeout(() => removeToast(toastId), duration);
};

window.removeToast = function(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
        toast.classList.add('removing');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }
};

// Helper functions
window.showSuccess = function(message, duration) {
    return window.showToast(message, 'success', duration);
};

window.showError = function(message, duration) {
    return window.showToast(message, 'error', duration);
};

window.showWarning = function(message, duration) {
    return window.showToast(message, 'warning', duration);
};

window.showInfo = function(message, duration) {
    return window.showToast(message, 'info', duration);
};
</script>
@endpush
@endonce
