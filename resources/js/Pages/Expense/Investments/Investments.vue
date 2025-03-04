<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import DotsIcon from '@/Components/Icons/DotsIcon.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';
import EditInvestmentGainForm from '@/Pages/Expense/Investments/EditInvestmentGainForm.vue';
import EditNewInvestmentForm from '@/Pages/Expense/Investments/EditNewInvestmentForm.vue';

import AddInvestmentGainForm from '@/Pages/Expense/Investments/AddInvestmentGainForm.vue';
import AddNewInvestmentForm from '@/Pages/Expense/Investments/AddNewInvestmentForm.vue';

import { useEditMode } from '@/Composables/useEditMode';

import { nextTick, ref } from 'vue';

const { isEditing } = useEditMode();

type AddModalType = 'addInvestmentGain' | 'addNewInvestment';

type EditModalType = 'editInvestmentGain' | 'editNewInvestment';

type ModalType = AddModalType | EditModalType;

const modals = ref<Record<ModalType, boolean>>({
    addInvestmentGain: false,
    editInvestmentGain: false,
    addNewInvestment: false,
    editNewInvestment: false,
});

const toggleModal = (type: ModalType) => {
    modals.value[type] = !modals.value[type];
};

type Item = { id: number; type: string; income: string; value: string };

const itemToEdit = ref<Item | null>(null);

const editItem = async (type: EditModalType, item: Item) => {
    itemToEdit.value = { ...item };
    await nextTick();
    toggleModal(type);
};
</script>

<template>
    <div class="grid w-full gap-10 md:grid-cols-2">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Ganhos de Investimentos
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Retorno financeiro dos seus investimentos no mês anterior.</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('addInvestmentGain')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>100,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editInvestmentGain', { id: 1, type: 'FII', income: '1', value: '1.000,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>9,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editInvestmentGain', { id: 2, type: 'Renda Fixa', income: '0.9', value: '9,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>23,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editInvestmentGain', { id: 3, type: 'Tesouro', income: '2', value: '23,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>132,00</TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
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
                        <PlusButton @click="toggleModal('addNewInvestment')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>500,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editNewInvestment', { id: 1, type: 'FII', income: '1', value: '500,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Criptomoeda</ThBody>
                    <TdBody></TdBody>
                    <TdBody>200,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editNewInvestment', { id: 2, type: 'Criptomoeda', income: '', value: '200,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>500,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editNewInvestment', { id: 3, type: 'Renda Fixa', income: '0.9', value: '500,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>500,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editNewInvestment', { id: 4, type: 'Tesouro', income: '2', value: '500,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>1.700,00</TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
            </template>
        </Table>
    </div>

    <AddInvestmentGainForm :showAddInvestmentGainModal="modals.addInvestmentGain" @close="toggleModal('addInvestmentGain')" />
    <EditInvestmentGainForm :showEditInvestmentGainModal="modals.editInvestmentGain" @close="toggleModal('editInvestmentGain')" :item="itemToEdit" />

    <AddNewInvestmentForm :showAddNewInvestmentModal="modals.addNewInvestment" @close="toggleModal('addNewInvestment')" />
    <EditNewInvestmentForm :showEditNewInvestmentModal="modals.editNewInvestment" @close="toggleModal('editNewInvestment')" :item="itemToEdit" />
</template>
