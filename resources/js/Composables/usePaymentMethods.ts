import { PaymentMethod } from '@/Pages/Settings/PaymentMethods.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const PAYMENT_METHODS_KEY: InjectionKey<{
    paymentMethods: Ref<PaymentMethod[]>;
    addPaymentMethod: (paymentMethod: PaymentMethod) => void;
}> = Symbol('paymentMethods');

export function providePaymentMethods(): void {
    const paymentMethods: Ref<PaymentMethod[]> = ref([]);

    const addPaymentMethod = (paymentMethod: PaymentMethod): void => {
        paymentMethods.value.push(paymentMethod);
    };

    // TODO :: MELHORAR ISSO, TALVEZ VIRAR UM COMPONENT DE FETCH QUE SUBA UM POPUP DE ERRO E ETC
    const fetchPaymentMethods = async () => {
        try {
            const { data } = await axios.get('/payment-methods');
            paymentMethods.value = data.data;
        } catch (error) {
            paymentMethods.value = [];
        }
    };

    onMounted(fetchPaymentMethods);

    provide(PAYMENT_METHODS_KEY, { paymentMethods, addPaymentMethod });
}

export function usePaymentMethods() {
    const paymentMethods = inject(PAYMENT_METHODS_KEY);

    if (!paymentMethods) {
        throw new Error('usePaymentMethods must be used within a providePaymentMethods');
    }

    return paymentMethods;
}
