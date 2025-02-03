<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';
import AddApplicationForm from '@/Pages/Expense/Investments/AddApplicationForm.vue';
import AddIncomeForm from '@/Pages/Expense/Investments/AddIncomeForm.vue';

import { ref } from 'vue';

const modals = ref({
    income: false,
    application: false,
});

const toggleModal = (type: 'income' | 'application') => {
    modals.value[type] = !modals.value[type];
};
</script>

<template>
    <div class="grid w-full gap-10 md:grid-cols-2">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Ganhos com Investimentos
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Retorno financeiro dos seus investimentos no mês anterior.</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('income')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>100,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>9,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>23,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>132,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Novos Investimentos
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores que foram investidos neste mês.</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('application')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>500,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Criptomoeda</ThBody>
                    <TdBody></TdBody>
                    <TdBody>200,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>500,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>500,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>1.700,00</TdFoot>
            </template>
        </Table>
    </div>

    <AddIncomeForm :showIncomeModal="modals.income" @close="toggleModal('income')" />
    <AddApplicationForm :showApplicationModal="modals.application" @close="toggleModal('application')" />
</template>
