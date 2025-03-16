import { inject, InjectionKey, provide, Ref, ref } from 'vue';

type ToastType = 'success' | 'error' | 'warning';

const TOAST_KEY: InjectionKey<{
    showToast: Ref<boolean>;
    toastMessage: Ref<string>;
    toastType: Ref<ToastType>;
    triggerToast: (type: ToastType, message: string, timeout?: number) => void;
}> = Symbol('toast');

export function provideToast() {
    const showToast = ref(false);
    const toastMessage = ref('');
    const toastType = ref<ToastType>('success');

    const triggerToast = (type: ToastType, message: string, timeout = 3000) => {
        toastType.value = type;
        toastMessage.value = message;
        showToast.value = true;

        setTimeout(() => {
            showToast.value = false;
        }, timeout);
    };

    provide(TOAST_KEY, { showToast, toastMessage, toastType, triggerToast });
}

export function useToast() {
    const toast = inject(TOAST_KEY);

    if (!toast) {
        throw new Error('useToast must be used within a provideToast');
    }

    return toast;
}
