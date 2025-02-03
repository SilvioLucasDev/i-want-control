<script setup lang="ts">
import PieChart from '@/Components/PieChart.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';
</script>

<template>
    <div class="grid w-full gap-10 md:grid-cols-2">
        <Table>
            <template #header>
                Receitas Totais
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valor total recebido neste mês.</p>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>Entradas Fixas</ThBody>
                    <TdBody>2.500,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Entradas Variáveis</ThBody>
                    <TdBody>300,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Saques de Investimentos</ThBody>
                    <TdBody>231,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.031,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                Despesas Totais
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valor total gasto neste mês.</p>
            </template>

            <template #thead>
                <ThHead class="text-start">Tipo</ThHead>
                <ThHead>Valor</ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>C6</ThBody>
                    <TdBody>2.500,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Nubank</ThBody>
                    <TdBody>300,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Itaú</ThBody>
                    <TdBody>550,00</TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Dinheiro</ThBody>
                    <TdBody>550,00</TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.900,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                Novos Investimentos
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Valor total investido neste mês.</p>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.900,00</TdFoot>
            </template>
        </Table>

        <Table>
            <template #header>
                Saldo Final
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Diferença entre receitas e despesas.</p>
            </template>

            <template #tfoot>
                <ThFoot>Total</ThFoot>
                <TdFoot>3.900,00</TdFoot>
            </template>
        </Table>

        <div class="flex items-center justify-center md:col-span-2">
            <PieChart />
        </div>
    </div>
</template>
