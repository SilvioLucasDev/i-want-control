import { useToast } from '@/Composables/useToast';

import { Investment } from '@/Pages/Settings/Investments.vue';

import axios from 'axios';
import { inject, InjectionKey, onMounted, provide, Ref, ref } from 'vue';

const INVESTMENTS_KEY: InjectionKey<{
    investments: Ref<Investment[]>;
    addInvestment: (investment: Investment) => Promise<boolean>;
    updateInvestment: (investment: Investment) => Promise<void>;
    removeInvestment: (id: number) => Promise<void>;
}> = Symbol('investments');

export function provideInvestments(): void {
    const { triggerToast } = useToast();

    const investments: Ref<Investment[]> = ref([]);

    const fetchInvestments = async () => {
        try {
            const { data } = await axios.get('/investments');

            investments.value = data.data.map((item: Investment) => ({
                ...item,
                isEditing: false,
            }));
        } catch (error) {
            triggerToast('error', 'Erro ao carregar investimentos.');
            investments.value = [];
        }
    };

    const addInvestment = async (investment: Investment): Promise<boolean> => {
        try {
            const { data } = await axios.post('/investments', investment);
            investments.value.push({ ...data.data, isEditing: false });

            triggerToast('success', 'Investimento adicionado com sucesso!');

            return true;
        } catch (error) {
            handleApiError(error, 'Erro ao adicionar investimento.');

            return false;
        }
    };

    const updateInvestment = async (investment: Investment): Promise<void> => {
        try {
            await axios.put(`/investments/${investment.id}`, {
                type: investment.type,
                income: investment.income,
            });

            const index = investments.value.findIndex((item) => item.id === investment.id);
            if (index !== -1) {
                investments.value[index] = { ...investment, isEditing: false };
            }

            triggerToast('success', 'Investimento atualizado com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao atualizar investimento.');
        }
    };

    const removeInvestment = async (investmentId: number): Promise<void> => {
        try {
            await axios.delete(`/investments/${investmentId}`);

            investments.value = investments.value.filter((item) => item.id !== investmentId);

            triggerToast('success', 'Investimento removido com sucesso!');
        } catch (error) {
            handleApiError(error, 'Erro ao remover investimento.');
        }
    };

    const handleApiError = (error: any, defaultMessage: string) => {
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
