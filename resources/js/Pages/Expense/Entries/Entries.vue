<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';

import AddRecurrentForm from '@/Pages/Expense/Entries/AddRecurrentForm.vue';
import AddToReceiveForm from '@/Pages/Expense/Entries/AddToReceiveForm.vue';

import { ref } from 'vue';

const showRecurrentModal = ref<boolean>(false);

const showRecurrentToggle = (): void => {
    showRecurrentModal.value = !showRecurrentModal.value;
};

const showToReceiveModal = ref<boolean>(false);

const showToReceiveToggle = (): void => {
    showToReceiveModal.value = !showToReceiveModal.value;
};
</script>

<template>
    <div class="grid w-full gap-10 md:grid-cols-3">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Recorrentes
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores fixos que eu recebo todos os meses</p>
                    </div>
                    <div>
                        <PlusButton @click="showRecurrentToggle" />
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
                        Á receber
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores dinâmicos que eu irei receber esse mês</p>
                    </div>
                    <div>
                        <PlusButton @click="showToReceiveToggle" />
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
                Investimentos
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores que saquei dos meus investimentos</p>
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

    <AddRecurrentForm :showRecurrentModal="showRecurrentModal" @close="showRecurrentToggle" />
    <AddToReceiveForm :showToReceiveModal="showToReceiveModal" @close="showToReceiveToggle" />
</template>
