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

const addRecurrent = (): void => {
    console.log('DASHBOARD :: Add Recurrence');
};
</script>

<template>
    <div class="grid w-full gap-10 xl:col-span-3">
        <div class="grid gap-10 xl:grid-cols-2">
            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Necessidades
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Gastos necessários de todo mês</p>
                        </div>
                        <div>
                            <PlusButton @click="addRecurrent" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Luz</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aluguel</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>1.500,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Internet</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>1.820,00</TdFoot>
                    <!-- <TdFoot></TdFoot> -->
                </template>
            </Table>

            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Recorrentes
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Compras realizadas todos os meses (Streamers...)</p>
                        </div>
                        <div>
                            <PlusButton @click="addRecurrent" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>ChatGPT</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>115,24</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Youtube Premium</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>41,90</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>PetLove</ThBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>75,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Cabeleireiro</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>353,14</TdFoot>
                    <!-- <TdFoot></TdFoot> -->
                </template>
            </Table>
        </div>

        <div class="grid gap-10 xl:grid-cols-2">
            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Á vista
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Compras á vista</p>
                        </div>
                        <div>
                            <PlusButton @click="addRecurrent" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Corrente da Moto</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>165,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                            </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Presente da Maria</ThBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>303,50</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                            </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Viagem da Praia</ThBody>
                        <TdBody><DarkBadge>Dinheiro</DarkBadge></TdBody>
                        <TdBody>450,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                            </TdBody> -->
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>918,50</TdFoot>
                    <!-- <TdFoot></TdFoot> -->
                </template>
            </Table>

            <Table>
                <template #header>
                    <div class="flex justify-between">
                        <div>
                            Parceladas
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Compras parceladas</p>
                        </div>
                        <div>
                            <PlusButton @click="addRecurrent" />
                        </div>
                    </div>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Parcela</ThHead>
                    <ThHead>Forma de Pagamento</ThHead>
                    <ThHead>Valor</ThHead>
                    <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>C6</ThBody>
                        <TdBody>1/2</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>200,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Nubank</ThBody>
                        <TdBody>1/7</TdBody>
                        <TdBody><DarkBadge>Nubank</DarkBadge></TdBody>
                        <TdBody>980,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Itaú</ThBody>
                        <TdBody>1/15</TdBody>
                        <TdBody><DarkBadge>Itaú</DarkBadge></TdBody>
                        <TdBody>120,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Notebook</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>650,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Aliexpress</ThBody>
                        <TdBody>3/12</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>1.555,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Portão</ThBody>
                        <TdBody>5/6</TdBody>
                        <TdBody><DarkBadge>C6</DarkBadge></TdBody>
                        <TdBody>95,00</TdBody>
                        <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot>Total</ThFoot>
                    <TdFoot></TdFoot>
                    <TdFoot></TdFoot>
                    <TdFoot>3.000,00</TdFoot>
                    <!-- <TdFoot></TdFoot> -->
                </template>
            </Table>
        </div>
    </div>
</template>
