import { inject, InjectionKey, provide, Ref, ref } from 'vue';

type ToastType = 'success' | 'error' | 'warning';

interface Toast {
    id: number;
    type: ToastType;
    message: string;
}

const TOAST_KEY: InjectionKey<{
    toasts: Ref<Toast[]>;
    triggerToast: (type: ToastType, message: string, timeout?: number) => void;
}> = Symbol('toast');

export function provideToast() {
    const toasts = ref<Toast[]>([]);
    let toastId = 0;

    const triggerToast = (type: ToastType, message: string, timeout = 3000) => {
        const id = toastId++;
        toasts.value.push({ id, type, message });

        setTimeout(() => {
            toasts.value = toasts.value.filter((toast) => toast.id !== id);
        }, timeout);
    };

    provide(TOAST_KEY, { toasts, triggerToast });
}

export function useToast() {
    const toast = inject(TOAST_KEY);

    if (!toast) {
        throw new Error('useToast must be used within a provideToast');
    }

    return toast;
}
