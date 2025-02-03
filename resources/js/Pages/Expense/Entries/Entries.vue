<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';

import AddFixedInputForm from '@/Pages/Expense/Entries/AddFixedInputForm.vue';
import AddVariableInputForm from '@/Pages/Expense/Entries/AddVariableInputForm.vue';

import { ref } from 'vue';

const modals = ref({
    variableInput: false,
    fixedInput: false,
});

const toggleModal = (type: 'fixedInput' | 'variableInput') => {
    modals.value[type] = !modals.value[type];
};
</script>

<template>
    <div class="grid w-full gap-10 md:grid-cols-3">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Entradas fixas
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores que recebo regularmente, como salário e benefícios.</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('fixedInput')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>Salário</ThBody>
                    <TdBody>1.000,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Vale Refeição</ThBody>
                    <TdBody>1.000,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Auxilio</ThBody>
                    <TdBody>1.000,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.000,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Entradas Variáveis
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Ganhos esporádicos ou extras, como freelas e pagamentos pendentes.</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('variableInput')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>João</ThBody>
                    <TdBody>434,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Freelas</ThBody>
                    <TdBody>1.000,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>1.434,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                Saques de Investimentos
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Resgates feitos de investimentos neste mês.</p>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>500,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Criptomoeda</ThBody>
                    <TdBody>500,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>1.000,00</TdFoot>
            </template>
        </Table>
    </div>

    <AddFixedInputForm :showFixedInputModal="modals.fixedInput" @close="toggleModal('fixedInput')" />
    <AddVariableInputForm :showVariableInputModal="modals.variableInput" @close="toggleModal('variableInput')" />
</template>
