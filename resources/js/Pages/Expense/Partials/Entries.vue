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
    <div class="grid w-full gap-10 md:grid-cols-3">
        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div>
                        Recorrentes
                        <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valores fixos que eu recebo todos os meses</p>
                    </div>
                    <div>
                        <PlusButton @click="addRecurrent" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
                <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>Salário</ThBody>
                    <TdBody>1.000,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Vale Refeição</ThBody>
                    <TdBody>1.000,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Auxilio</ThBody>
                    <TdBody>1.000,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.000,00</TdFoot>
                <!-- <TdFoot></TdFoot> -->
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
                        <PlusButton @click="addRecurrent" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
                <!-- <ThHead screenReaderOnly> Edit </ThHead> -->
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>João</ThBody>
                    <TdBody>434,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Freelas</ThBody>
                    <TdBody>1.000,00</TdBody>
                    <!-- <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody> -->
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>1.434,00</TdFoot>
                <!-- <TdFoot></TdFoot> -->
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
</template>
