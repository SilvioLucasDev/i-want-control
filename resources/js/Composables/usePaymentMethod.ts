import { PaymentMethod } from '@/Pages/Settings/PaymentMethods.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PAYMENT_METHOD_KEY: InjectionKey<{
    isPaymentMethods: Ref<PaymentMethod[]>;
    addPaymentMethod: (paymentMethod: PaymentMethod) => void;
    fetchPaymentMethods: () => void
}> = Symbol('paymentType');

export function providePaymentMethod(): void {
    const isPaymentMethods: Ref<PaymentMethod[]> = ref([]);

    const addPaymentMethod = (paymentMethod: PaymentMethod): void => {
        isPaymentMethods.value.push(paymentMethod);
    };

    const fetchPaymentMethods = async () => {
        try {
            const { data } = await axios.get('/payment-methods');
            isPaymentMethods.value = data.data;
        } catch (error) {
            isPaymentMethods.value = [];
        }
    };

    provide(PAYMENT_METHOD_KEY, { isPaymentMethods, addPaymentMethod, fetchPaymentMethods });
}

export function usePaymentType() {
    const paymentMethod = inject(PAYMENT_METHOD_KEY);

    if (!paymentMethod) {
        throw new Error('usePaymentType must be used within a providePaymentMethod');
    }

    return paymentMethod;
}
