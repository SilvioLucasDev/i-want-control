import { Investment } from '@/Pages/Settings/Investments.vue';
import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const INVESTMENTS_KEY: InjectionKey<{
    investments: Ref<Investment[]>;
    addInvestment: (investment: Investment) => void;
}> = Symbol('investments');

export function provideInvestments(): void {
    const investments: Ref<Investment[]> = ref([]);

    const addInvestment = (investment: Investment): void => {
        investments.value.push(investment);
    };

    // TODO :: MELHORAR ISSO, TALVEZ VIRAR UM COMPONENT DE FETCH QUE SUBA UM POPUP DE ERRO E ETC
    const fetchInvestments = async () => {
        try {
            const { data } = await axios.get('/investments');
            investments.value = data.data;
        } catch (error) {
            investments.value = [];
        }
    };

    onMounted(fetchInvestments);

    provide(INVESTMENTS_KEY, { investments, addInvestment });
}

export function useInvestments() {
    const investments = inject(INVESTMENTS_KEY);

    if (!investments) {
        throw new Error('useInvestments must be used within a provideInvestments');
    }

    return investments;
}
