<script setup lang="ts">
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
    <div class="grid w-full gap-10 md:grid-cols-2">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Rendimentos
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores respectivo aos rendimentos do mês anterior</p>
                    </div>
                    <div>
                        <PlusButton @click="addRecurrent" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
                <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>100,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>9,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>23,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>132,00</TdFoot>
                <!-- <TdFoot></TdFoot> -->
            </template>
        </Table>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Aplicações
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores investido nesse mês</p>
                    </div>
                    <div>
                        <PlusButton @click="addRecurrent" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Rentabilidade</ThHead>
                <ThHead>Valor</ThHead>
                <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>FII</ThBody>
                    <TdBody>1%</TdBody>
                    <TdBody>500,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Criptomoeda</ThBody>
                    <TdBody></TdBody>
                    <TdBody>200,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Renda Fixa</ThBody>
                    <TdBody>0.9%</TdBody>
                    <TdBody>500,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Tesouro</ThBody>
                    <TdBody>2%</TdBody>
                    <TdBody>500,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot></TdFoot>
                <TdFoot>1.700,00</TdFoot>
                <!-- <TdFoot></TdFoot> -->
            </template>
        </Table>
    </div>
</template>
