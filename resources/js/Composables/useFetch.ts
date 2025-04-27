import { useToast } from '@/Composables/useToast';

import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from 'axios';
import { ref } from 'vue';

export async function useFetch<T = any>(url: string, config: AxiosRequestConfig = {}) {
    const data = ref<T | null>(null);
    const error = ref<AxiosError | null>(null);
    const loading = ref(false);

    loading.value = true;
    error.value = null;
    data.value = null;

    try {
        const response: AxiosResponse<{ data: T }> = await axios({
            url,
            ...config,
        });

        data.value = response.data.data;
    } catch (err: any) {
        error.value = err;
    } finally {
        loading.value = false;
    }

    return {
        data,
        error,
        loading,
    };
}

export function useFetchError() {
    const { triggerToast } = useToast();

    const handleError = (error: any, defaultMessage = 'Erro ao processar requisição.') => {
        if (axios.isAxiosError(error) && error.response) {
            if (error.response.status === 422) {
                const errors = error.response.data?.errors;

                if (errors && typeof errors === 'object') {
                    const allErrors: string[] = Object.values(errors).flatMap((err) => (Array.isArray(err) ? err : [String(err)]));

                    allErrors.forEach((errorMessage) => {
                        triggerToast('error', errorMessage);
                    });
                } else {
                    triggerToast('error', error.response.data?.message || 'Erro de validação.');
                }
            } else {
                triggerToast('error', error.response.data?.message || defaultMessage);
            }
        } else {
            triggerToast('error', defaultMessage);
        }
    };

    return { handleError };
}
