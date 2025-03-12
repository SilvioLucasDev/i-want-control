import { Investment } from '@/Pages/Settings/Investments.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const INVESTMENT_METHOD_KEY: InjectionKey<{
    isInvestments: Ref<Investment[]>;
    addInvestment: (investment: Investment) => void;
    fetchInvestments: () => void
}> = Symbol('investmentType');

export function provideInvestment(): void {
    const isInvestments: Ref<Investment[]> = ref([]);

    const addInvestment = (investment: Investment): void => {
        isInvestments.value.push(investment);
    };

    const fetchInvestments = async () => {
        try {
            const { data } = await axios.get('/investments');
            isInvestments.value = data.data;
        } catch (error) {
            isInvestments.value = [];
        }
    };

    onMounted(fetchInvestments);

    provide(INVESTMENT_METHOD_KEY, { isInvestments, addInvestment, fetchInvestments });
}

export function useInvestmentType() {
    const investment = inject(INVESTMENT_METHOD_KEY);

    if (!investment) {
        throw new Error('useInvestmentType must be used within a provideInvestment');
    }

    return investment;
}
