<script setup lang="ts">
import DarkBadge from '@/Components/Badges/DarkBadge.vue';
import PlusButton from '@/Components/Buttons/PlusButton.vue';
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

import { ref } from 'vue';

const modals = ref({
    fixedExpense: false,
    signature: false,
    singlePayment: false,
    installmentPayment: false,
});

const toggleModal = (type: 'fixedExpense' | 'signature' | 'singlePayment' | 'installmentPayment') => {
    modals.value[type] = !modals.value[type];
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
                            <PlusButton @click="toggleModal('fixedExpense')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Luz</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aluguel</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>1.500,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Internet</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>1.820,00</TdFoot>
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
                            <PlusButton @click="toggleModal('signature')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>ChatGPT</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>115,24</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Youtube Premium</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>41,90</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>PetLove</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>75,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Cabeleireiro</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>353,14</TdFoot>
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
                            <PlusButton @click="toggleModal('singlePayment')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Corrente da Moto</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>165,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Presente da Maria</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>303,50</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Viagem da Praia</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>450,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>918,50</TdFoot>
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
                            <PlusButton @click="toggleModal('installmentPayment')" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Parcela</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>C6</ThBody>
                        <TdBody>1/2</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Nubank</ThBody>
                        <TdBody>1/7</TdBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>980,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Itaú</ThBody>
                        <TdBody>1/15</TdBody>
                        <TdBody><DarkBadge>Itaú</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Notebook</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>650,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aliexpress</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>1.555,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Portão</ThBody>
                        <TdBody>5/6</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>95,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>3.000,00</TdFoot>
                </template>
            </Table>
        </div>
    </div>

    <AddFixedExpenseForm :showFixedExpenseModal="modals.fixedExpense" @close="toggleModal('fixedExpense')" />
    <AddSignatureForm :showSignatureModal="modals.signature" @close="toggleModal('signature')" />
    <AddSinglePaymentForm :showSinglePaymentModal="modals.singlePayment" @close="toggleModal('singlePayment')" />
    <AddInstallmentPaymentForm :showInstallmentPaymentModal="modals.installmentPayment" @close="toggleModal('installmentPayment')" />
</template>
