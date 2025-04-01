import { ref } from 'vue';

type ToastType = 'success' | 'error' | 'warning';

interface Toast {
    id: number;
    type: ToastType;
    message: string;
}

const toasts = ref<Toast[]>([]);
let toastId = 0;

const triggerToast = (type: ToastType, message: string, timeout = 3000) => {
    const id = toastId++;
    toasts.value.push({ id, type, message });

    setTimeout(() => {
        toasts.value = toasts.value.filter((toast) => toast.id !== id);
    }, timeout);
};

export function useToast() {
    return { toasts, triggerToast };
}
