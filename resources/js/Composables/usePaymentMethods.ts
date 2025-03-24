import { useFetch, useFetchError } from '@/Composables/useFetch';
import { useToast } from '@/Composables/useToast';

import { PaymentMethod } from '@/Pages/Settings/PaymentMethods.vue';

import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PAYMENT_METHODS_KEY: InjectionKey<{
    paymentMethods: Ref<PaymentMethod[]>;
    addPaymentMethod: (paymentMethod: PaymentMethod) => Promise<boolean>;
    updatePaymentMethod: (paymentMethod: PaymentMethod) => Promise<boolean>;
    removePaymentMethod: (id: number) => Promise<boolean>;
}> = Symbol('paymentMethods');

export function providePaymentMethods(): void {
    const { triggerToast } = useToast();
    const { handleError } = useFetchError();

    const paymentMethods: Ref<PaymentMethod[]> = ref([]);

    const fetchPaymentMethods = async (): Promise<boolean> => {
        const { data, error } = await useFetch<PaymentMethod[]>(route('payment-methods.index'));

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao carregar métodos de pagamento.');
            paymentMethods.value = [];
            return false;
        }

        paymentMethods.value = data.value.map((item) => ({
            ...item,
            isEditing: false,
        }));
        return true;
    };

    const addPaymentMethod = async (paymentMethod: PaymentMethod): Promise<boolean> => {
        const { data, error } = await useFetch<PaymentMethod>(route('payment-methods.store'), {
            method: 'POST',
            data: paymentMethod,
        });

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao adicionar método de pagamento.');
            return false;
        }

        paymentMethods.value.push({ ...data.value, isEditing: false });
        triggerToast('success', 'Método de pagamento adicionado com sucesso!');
        return true;
    };

    const updatePaymentMethod = async (paymentMethod: PaymentMethod): Promise<boolean> => {
        const { error } = await useFetch(route('payment-methods.update', { paymentMethod: paymentMethod.id }), {
            method: 'PUT',
            data: { type: paymentMethod.type },
        });

        if (error.value) {
            handleError(error.value, 'Erro ao atualizar método de pagamento.');
            return false;
        }

        const index = paymentMethods.value.findIndex((item) => item.id === paymentMethod.id);
        if (index !== -1) {
            paymentMethods.value[index] = { ...paymentMethod, isEditing: false };
        }

        triggerToast('success', 'Método de pagamento atualizado com sucesso!');
        return true;
    };

    const removePaymentMethod = async (paymentMethodId: number): Promise<boolean> => {
        const { error } = await useFetch(route('payment-methods.destroy', { paymentMethod: paymentMethodId }), {
            method: 'DELETE',
        });

        if (error.value) {
            handleError(error.value, 'Erro ao remover método de pagamento.');
            return false;
        }

        paymentMethods.value = paymentMethods.value.filter((item) => item.id !== paymentMethodId);
        triggerToast('success', 'Método de pagamento removido com sucesso!');
        return true;
    };

    onMounted(fetchPaymentMethods);

    provide(PAYMENT_METHODS_KEY, { paymentMethods, addPaymentMethod, updatePaymentMethod, removePaymentMethod });
}

export function usePaymentMethods() {
    const paymentMethods = inject(PAYMENT_METHODS_KEY);

    if (!paymentMethods) {
        throw new Error('usePaymentMethods must be used within a providePaymentMethods');
    }

    return paymentMethods;
}
