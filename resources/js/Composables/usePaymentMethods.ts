import { PaymentMethod } from '@/Pages/Settings/PaymentMethods.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PAYMENT_METHODS_KEY: InjectionKey<{
    paymentMethods: Ref<PaymentMethod[]>;
    findPaymentMethod: (paymentMethodId: number) => PaymentMethod | undefined;
    addPaymentMethod: (paymentMethod: PaymentMethod) => void;
    updatePaymentMethod: (paymentMethod: PaymentMethod) => void;
    removePaymentMethod: (id: number) => void;
}> = Symbol('paymentMethods');

export function providePaymentMethods(): void {
    const paymentMethods: Ref<PaymentMethod[]> = ref([]);

    // TODO :: MELHORAR ISSO, TALVEZ VIRAR UM COMPONENT DE FETCH QUE SUBA UM POPUP DE ERRO E ETC
    const fetchPaymentMethods = async () => {
        try {
            const { data } = await axios.get('/payment-methods');
            paymentMethods.value = data.data.map((item: PaymentMethod) => ({
                ...item,
                isEditing: false,
            }));
        } catch (error) {
            paymentMethods.value = [];
        }
    };

    const findPaymentMethod = (paymentMethodId: number): PaymentMethod | undefined => {
        return paymentMethods.value.find((item) => item.id === paymentMethodId);
    };

    const addPaymentMethod = (paymentMethod: PaymentMethod): void => {
        paymentMethods.value.push({ ...paymentMethod, isEditing: false });
    };

    const updatePaymentMethod = (paymentMethod: PaymentMethod): void => {
        const index = paymentMethods.value.findIndex((item) => item.id === paymentMethod.id);
        if (index !== -1) {
            paymentMethods.value[index] = { ...paymentMethod, isEditing: false };
        }
    };

    const removePaymentMethod = (paymentMethodId: number): void => {
        paymentMethods.value = paymentMethods.value.filter((item) => item.id !== paymentMethodId);
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
