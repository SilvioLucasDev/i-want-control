<script setup lang="ts">
import DarkBadge from '@/Components/Badges/DarkBadge.vue';
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

import AddFixedExpenseForm from '@/Pages/Expense/Outputs/AddFixedExpenseForm.vue';
import AddInstallmentPaymentForm from '@/Pages/Expense/Outputs/AddInstallmentPaymentForm.vue';
import AddSignatureForm from '@/Pages/Expense/Outputs/AddSignatureForm.vue';
import AddSinglePaymentForm from '@/Pages/Expense/Outputs/AddSinglePaymentForm.vue';
import EditFixedExpenseForm from '@/Pages/Expense/Outputs/EditFixedExpenseForm.vue';
import EditInstallmentPaymentForm from '@/Pages/Expense/Outputs/EditInstallmentPaymentForm.vue';
import EditSignatureForm from '@/Pages/Expense/Outputs/EditSignatureForm.vue';
import EditSinglePaymentForm from '@/Pages/Expense/Outputs/EditSinglePaymentForm.vue';

import { useEditMode } from '@/Composables/useEditMode';
import { nextTick, ref } from 'vue';

const { isEditing } = useEditMode();

type AddModalType = 'addFixedExpense' | 'addSignature' | 'addSinglePayment' | 'addInstallmentPayment';

type EditModalType = 'editFixedExpense' | 'editSignature' | 'editSinglePayment' | 'editInstallmentPayment';

type ModalType = AddModalType | EditModalType;

const modals = ref<Record<ModalType, boolean>>({
    addFixedExpense: false,
    editFixedExpense: false,
    addSignature: false,
    editSignature: false,
    addSinglePayment: false,
    editSinglePayment: false,
    addInstallmentPayment: false,
    editInstallmentPayment: false,
});

const toggleModal = (type: ModalType) => {
    modals.value[type] = !modals.value[type];
};

type Item = { id: number; type: string; paymentType: string; value: string; recurrent?: boolean; installments?: string };

const itemToEdit = ref<Item | null>(null);

const editItem = async (type: EditModalType, item: Item) => {
    itemToEdit.value = { ...item };
    await nextTick();
    toggleModal(type);
};
</script>

<template>
    <div class="grid w-full gap-10 xl:col-span-3">
        <div class="grid gap-10 xl:grid-cols-2">
            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Despesas Fixas
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Gastos essenciais e recorrentes, como contas e aluguel.</p>
                        </div>
                        <div>
                            <PlusButton @click="toggleModal('addFixedExpense')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <ThHead v-if="isEditing" class="px-0"></ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Luz</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editFixedExpense', { id: 1, type: 'Luz', paymentType: '0', value: '200,00', recurrent: true })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aluguel</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>1.500,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editFixedExpense', { id: 2, type: 'Aluguel', paymentType: '0', value: '1.500,00', recurrent: true })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Internet</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editFixedExpense', { id: 3, type: 'Internet', paymentType: '0', value: '120,00', recurrent: true })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>1.820,00</TdFoot>
                    <TdFoot v-if="isEditing" class="px-0"></TdFoot>
                </template>
            </Table>

            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Assinaturas
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Pagamentos mensais, como serviços e assinaturas.</p>
                        </div>
                        <div>
                            <PlusButton @click="toggleModal('addSignature')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <ThHead v-if="isEditing" class="px-0"></ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>ChatGPT</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>115,24</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSignature', { id: 1, type: 'ChatGPT', paymentType: '3', value: '115,24' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Youtube Premium</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>41,90</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSignature', { id: 2, type: 'Youtube Premium', paymentType: '3', value: '41,90' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>PetLove</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>75,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSignature', { id: 3, type: 'PetLove', paymentType: '3', value: '75,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Cabeleireiro</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSignature', { id: 4, type: 'Cabeleireiro', paymentType: '0', value: '120,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>353,14</TdFoot>
                    <TdFoot v-if="isEditing" class="px-0"></TdFoot>
                </template>
            </Table>
        </div>

        <div class="grid gap-10 xl:grid-cols-2">
            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Pagamentos Únicos
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Compras pagas à vista, sem parcelamento.</p>
                        </div>
                        <div>
                            <PlusButton @click="toggleModal('addSinglePayment')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <ThHead v-if="isEditing" class="px-0"></ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Corrente da Moto</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>165,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSinglePayment', { id: 1, type: 'Corrente da Moto', paymentType: '4', value: '165,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Presente da Maria</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>303,50</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSinglePayment', { id: 2, type: 'Presente da Maria', paymentType: '4', value: '303,50' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Viagem da Praia</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>450,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editSinglePayment', { id: 3, type: 'Viagem da Praia', paymentType: '0', value: '450,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>918,50</TdFoot>
                    <TdFoot v-if="isEditing" class="px-0"></TdFoot>
                </template>
            </Table>

            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Pagamentos Parcelados
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Despesas divididas em várias parcelas.</p>
                        </div>
                        <div>
                            <PlusButton @click="toggleModal('addInstallmentPayment')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Parcela</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <ThHead v-if="isEditing" class="px-0"></ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>C6</ThBody>
                        <TdBody>1/2</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 1, type: 'C6', installments: '1/2', paymentType: '4', value: '200,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Nubank</ThBody>
                        <TdBody>1/7</TdBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>980,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 2, type: 'Nubank', installments: '1/7', paymentType: '3', value: '980,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Itaú</ThBody>
                        <TdBody>1/15</TdBody>
                        <TdBody><DarkBadge>Itaú</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 3, type: 'Itaú', installments: '1/15', paymentType: '5', value: '120,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Notebook</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>650,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 4, type: 'Notebook', installments: '3/12', paymentType: '4', value: '650,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aliexpress</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>1.555,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 5, type: 'Aliexpress', installments: '3/12', paymentType: '4', value: '1.555,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Portão</ThBody>
                        <TdBody>5/6</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>95,00</TdBody>

                        <TdBody v-if="isEditing" class="px-0">
                            <TransparentButton @click="editItem('editInstallmentPayment', { id: 6, type: 'Portão', installments: '5/6', paymentType: '4', value: '95,00' })">
                                <DotsIcon />
                            </TransparentButton>
                        </TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>3.000,00</TdFoot>
                    <TdFoot v-if="isEditing" class="px-0"></TdFoot>
                </template>
            </Table>
        </div>
    </div>

    <AddFixedExpenseForm :showAddFixedExpenseModal="modals.addFixedExpense" @close="toggleModal('addFixedExpense')" />
    <EditFixedExpenseForm :showEditFixedExpenseModal="modals.editFixedExpense" @close="toggleModal('editFixedExpense')" :item="itemToEdit" />

    <AddSignatureForm :showAddSignatureModal="modals.addSignature" @close="toggleModal('addSignature')" />
    <EditSignatureForm :showEditSignatureModal="modals.editSignature" @close="toggleModal('editSignature')" :item="itemToEdit" />

    <AddSinglePaymentForm :showAddSinglePaymentModal="modals.addSinglePayment" @close="toggleModal('addSinglePayment')" />
    <EditSinglePaymentForm :showEditSinglePaymentModal="modals.editSinglePayment" @close="toggleModal('editSinglePayment')" :item="itemToEdit" />

    <AddInstallmentPaymentForm :showAddInstallmentPaymentModal="modals.addInstallmentPayment" @close="toggleModal('addInstallmentPayment')" />
    <EditInstallmentPaymentForm :showEditInstallmentPaymentModal="modals.editInstallmentPayment" @close="toggleModal('editInstallmentPayment')" :item="itemToEdit" />
</template>
