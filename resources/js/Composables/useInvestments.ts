import { useFetch, useFetchError } from '@/Composables/useFetch';
import { useToast } from '@/Composables/useToast';

import { Investment } from '@/Pages/Settings/Investments.vue';

import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const INVESTMENTS_KEY: InjectionKey<{
    investments: Ref<Investment[]>;
    addInvestment: (investment: Investment) => Promise<boolean>;
    updateInvestment: (investment: Investment) => Promise<boolean>;
    removeInvestment: (id: number) => Promise<boolean>;
}> = Symbol('investments');

export function provideInvestments(): void {
    const { triggerToast } = useToast();
    const { handleError } = useFetchError();

    const investments: Ref<Investment[]> = ref([]);

    const fetchInvestments = async (): Promise<boolean> => {
        const { data, error } = await useFetch<Investment[]>('/investments');

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao carregar investimentos.');
            investments.value = [];

            return false;
        }

        investments.value = data.value.map((item) => ({
            ...item,
            isEditing: false,
        }));

        return true;
    };

    const addInvestment = async (investment: Investment): Promise<boolean> => {
        const { data, error } = await useFetch<Investment>('/investments', {
            method: 'POST',
            data: investment,
        });

        if (error.value || !data.value) {
            handleError(error.value, 'Erro ao adicionar investimento.');

            return false;
        }

        investments.value.push({ ...data.value, isEditing: false });
        triggerToast('success', 'Investimento adicionado com sucesso!');

        return true;
    };

    const updateInvestment = async (investment: Investment): Promise<boolean> => {
        const { error } = await useFetch(`/investments/${investment.id}`, {
            method: 'PUT',
            data: {
                type: investment.type,
                income: investment.income,
            },
        });

        if (error.value) {
            handleError(error.value, 'Erro ao atualizar investimento.');

            return false;
        }

        const index = investments.value.findIndex((item) => item.id === investment.id);
        if (index !== -1) {
            investments.value[index] = { ...investment, isEditing: false };
        }

        triggerToast('success', 'Investimento atualizado com sucesso!');

        return true;
    };

    const removeInvestment = async (investmentId: number): Promise<boolean> => {
        const { error } = await useFetch(`/investments/${investmentId}`, {
            method: 'DELETE',
        });

        if (error.value) {
            handleError(error.value, 'Erro ao remover investimento.');

            return false;
        }

        investments.value = investments.value.filter((item) => item.id !== investmentId);
        triggerToast('success', 'Investimento removido com sucesso!');

        return true;
    };

    onMounted(fetchInvestments);

    provide(INVESTMENTS_KEY, { investments, addInvestment, updateInvestment, removeInvestment });
}

export function useInvestments() {
    const investments = inject(INVESTMENTS_KEY);

    if (!investments) {
        throw new Error('useInvestments must be used within a provideInvestments');
    }

    return investments;
}
