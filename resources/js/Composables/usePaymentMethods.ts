import { useToast } from '@/Composables/useToast';
import { PaymentMethod } from '@/Pages/Settings/PaymentMethods.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PAYMENT_METHODS_KEY: InjectionKey<{
    paymentMethods: Ref<PaymentMethod[]>;
    findPaymentMethod: (paymentMethodId: number) => PaymentMethod | undefined;
    addPaymentMethod: (paymentMethod: PaymentMethod) => Promise<void>;
    updatePaymentMethod: (paymentMethod: PaymentMethod) => Promise<void>;
    removePaymentMethod: (id: number) => Promise<void>;
}> = Symbol('paymentMethods');

export function providePaymentMethods(): void {
    const { triggerToast } = useToast();

    const paymentMethods: Ref<PaymentMethod[]> = ref([]);

    const fetchPaymentMethods = async () => {
        try {
            const { data } = await axios.get('/payment-methods');

            paymentMethods.value = data.data.map((item: PaymentMethod) => ({
                ...item,
                isEditing: false,
            }));
        } catch (error) {
            triggerToast('error', 'Erro ao carregar métodos de pagamento.');
            paymentMethods.value = [];
        }
    };

    const findPaymentMethod = (paymentMethodId: number): PaymentMethod | undefined => {
        return paymentMethods.value.find((item) => item.id === paymentMethodId);
    };

    const addPaymentMethod = async (paymentMethod: PaymentMethod): Promise<void> => {
        try {
            const { data } = await axios.post('/payment-methods', paymentMethod);
            paymentMethods.value.push({ ...data.data, isEditing: false });

            triggerToast('success', 'Método de pagamento adicionado com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao adicionar método de pagamento.');
        }
    };

    const updatePaymentMethod = async (paymentMethod: PaymentMethod): Promise<void> => {
        try {
            await axios.put(`/payment-methods/${paymentMethod.id}`, { type: paymentMethod.type });

            const index = paymentMethods.value.findIndex((item) => item.id === paymentMethod.id);
            if (index !== -1) {
                paymentMethods.value[index] = { ...paymentMethod, isEditing: false };
            }

            triggerToast('success', 'Método de pagamento atualizado com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao atualizar método de pagamento.');
        }
    };

    const removePaymentMethod = async (paymentMethodId: number): Promise<void> => {
        try {
            await axios.delete(`/payment-methods/${paymentMethodId}`);

            paymentMethods.value = paymentMethods.value.filter((item) => item.id !== paymentMethodId);

            triggerToast('success', 'Método de pagamento removido com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao remover método de pagamento.');
        }
    };

    const handleApiError = (error: any, defaultMessage: string) => {
        if (axios.isAxiosError(error) && error.response) {
            if (error.response.status === 422) {
                const errorMessage = error.response.data?.message || 'Erro de validação.';
                triggerToast('error', errorMessage);
            } else {
                triggerToast('error', error.response.data?.message || defaultMessage);
            }
        } else {
            triggerToast('error', defaultMessage);
        }
    };

    onMounted(fetchPaymentMethods);

    provide(PAYMENT_METHODS_KEY, { paymentMethods, findPaymentMethod, addPaymentMethod, updatePaymentMethod, removePaymentMethod });
}

export function usePaymentMethods() {
    const paymentMethods = inject(PAYMENT_METHODS_KEY);

    if (!paymentMethods) {
        throw new Error('usePaymentMethods must be used within a providePaymentMethods');
    }

    return paymentMethods;
}
