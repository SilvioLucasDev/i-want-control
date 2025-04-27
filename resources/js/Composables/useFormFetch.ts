import axios, { AxiosError, AxiosRequestConfig, AxiosResponse } from 'axios';
import { reactive, ref } from 'vue';

type ValidationErrorResponse = {
    message: string;
    errors: Record<string, string[]>;
};

export function useFormFetch<TForm extends Record<string, any>>(initialData: TForm) {
    const form = reactive({ ...initialData });
    const errors = ref<Partial<Record<keyof TForm, string>>>({});
    const processing = ref(false);

    const reset = () => {
        Object.assign(form, initialData);
        errors.value = {};
    };

    const submit = async (method: 'post' | 'put' | 'patch' | 'delete', url: string, config: AxiosRequestConfig = {}) => {
        processing.value = true;
        errors.value = {};

        try {
            const response: AxiosResponse = await axios({
                method,
                url,
                data: form,
                ...config,
            });

            return { ok: true, data: response.data };
        } catch (err: unknown) {
            const axiosErr = err as AxiosError<ValidationErrorResponse>;

            if (axiosErr.response?.status === 422) {
                const fieldErrors = axiosErr.response.data.errors;

                const simplifiedErrors: Record<string, string> = {};
                for (const key in fieldErrors) {
                    simplifiedErrors[key] = Array.isArray(fieldErrors[key]) ? fieldErrors[key][0] : String(fieldErrors[key]);
                }

                errors.value = simplifiedErrors;
                return { ok: false, type: 'validation', errors: simplifiedErrors };
            }

            return { ok: false, type: 'generic', error: axiosErr.response?.data.message ?? axiosErr.message ?? 'Ocorreu um erro!' };
        } finally {
            processing.value = false;
        }
    };

    return {
        form,
        errors,
        processing,
        reset,
        submit,
    };
}
