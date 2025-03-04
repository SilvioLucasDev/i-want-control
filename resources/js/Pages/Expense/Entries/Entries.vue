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

import AddFixedInputForm from '@/Pages/Expense/Entries/AddFixedInputForm.vue';
import AddVariableInputForm from '@/Pages/Expense/Entries/AddVariableInputForm.vue';
import AddWithdrawalsFromInvestments from '@/Pages/Expense/Entries/AddWithdrawalsFromInvestments.vue';
import EditFixedInputForm from '@/Pages/Expense/Entries/EditFixedInputForm.vue';
import EditVariableInputForm from '@/Pages/Expense/Entries/EditVariableInputForm.vue';
import EditWithdrawalsFromInvestments from '@/Pages/Expense/Entries/EditWithdrawalsFromInvestments.vue';

import { useEditMode } from '@/Composables/useEditMode';

import { nextTick, ref } from 'vue';

const { isEditing } = useEditMode();

type AddModalType = 'addVariableInput' | 'addFixedInput' | 'addWithdrawalsFromInvestments';

type EditModalType = 'editVariableInput' | 'editFixedInput' | 'editWithdrawalsFromInvestments';

type ModalType = AddModalType | EditModalType;

const modals = ref<Record<ModalType, boolean>>({
    addVariableInput: false,
    editVariableInput: false,
    addFixedInput: false,
    editFixedInput: false,
    addWithdrawalsFromInvestments: false,
    editWithdrawalsFromInvestments: false,
});

const toggleModal = (type: ModalType) => {
    modals.value[type] = !modals.value[type];
};

type Item = { id: number; type: string; value: string; recurrent?: boolean };

const itemToEdit = ref<Item | null>(null);

const editItem = async (type: EditModalType, item: Item) => {
    itemToEdit.value = { ...item };
    await nextTick();
    toggleModal(type);
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
                        <PlusButton @click="toggleModal('addFixedInput')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>Salário</ThBody>
                    <TdBody>1.000,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editFixedInput', { id: 1, type: 'Salário', value: '1.000,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Vale Refeição</ThBody>
                    <TdBody>1.000,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editFixedInput', { id: 2, type: 'Vale Refeição', value: '1.000,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Auxilio</ThBody>
                    <TdBody>1.000,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editFixedInput', { id: 3, type: 'Auxilio', value: '1.000,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.000,00</TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
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
                        <PlusButton @click="toggleModal('addVariableInput')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>João</ThBody>
                    <TdBody>434,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editVariableInput', { id: 1, type: 'João', value: '434,00', recurrent: true })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Freelas</ThBody>
                    <TdBody>1.000,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editVariableInput', { id: 2, type: 'Freelas', value: '1.000,00', recurrent: true })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>1.434,00</TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Saques de Investimentos
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Resgates feitos de investimentos neste mês</p>
                    </div>
                    <div>
                        <PlusButton @click="toggleModal('addWithdrawalsFromInvestments')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>500,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editWithdrawalsFromInvestments', { id: 1, type: 'FII', value: '500,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Criptomoeda</ThBody>
                    <TdBody>500,00</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editWithdrawalsFromInvestments', { id: 2, type: 'Criptomoeda', value: '500,00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>1.000,00</TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
            </template>
        </Table>
    </div>

    <AddFixedInputForm :showAddFixedInputModal="modals.addFixedInput" @close="toggleModal('addFixedInput')" />
    <EditFixedInputForm :showEditFixedInputModal="modals.editFixedInput" :item="itemToEdit" @close="toggleModal('editFixedInput')" />

    <AddVariableInputForm :showAddVariableInputModal="modals.addVariableInput" @close="toggleModal('addVariableInput')" />
    <EditVariableInputForm :showEditVariableInputModal="modals.editVariableInput" :item="itemToEdit" @close="toggleModal('editVariableInput')" />

    <AddWithdrawalsFromInvestments :showAddWithdrawalsFromInvestmentsModal="modals.addWithdrawalsFromInvestments" @close="toggleModal('addWithdrawalsFromInvestments')" />
    <EditWithdrawalsFromInvestments :showEditWithdrawalsFromInvestmentsModal="modals.editWithdrawalsFromInvestments" :item="itemToEdit" @close="toggleModal('editWithdrawalsFromInvestments')" />
</template>
