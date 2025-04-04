<script setup lang="ts">
import ColumnChart from '@/Components/ColumnChart.vue';
import DashboardCard from '@/Components/DashboardCard.vue';
import ArrowUpRightIcon from '@/Components/Icons/ArrowUpRightIcon.vue';
import CashRegisterIcon from '@/Components/Icons/CashRegisterIcon.vue';
import DollarIcon from '@/Components/Icons/DollarIcon.vue';
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
    <div class="grid w-full gap-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
            <DashboardCard title="Receitas Totais" text="R$ 100,00">
                <DollarIcon />
            </DashboardCard>

            <DashboardCard title="Despesas Totais" text="R$ 1.200,00">
                <ArrowUpRightIcon />
            </DashboardCard>

            <DashboardCard title="Saldo Final" text="R$ 1.200,00">
                <CashRegisterIcon />
            </DashboardCard>
        </div>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-2">
            <Table>
                <template #header>
                    Principais Fontes de Renda
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Cálculo total das principais fontes de renda.</p>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Total</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Salário</ThBody>
                        <TdBody>2.500,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Auxilioo</ThBody>
                        <TdBody>300,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Freelas</ThBody>
                        <TdBody>231,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot></ThFoot>
                    <TdFoot></TdFoot>
                </template>
            </Table>

            <Table>
                <template #header>
                    Principais Despesas
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Cálculo total das principais fontes de despesas.</p>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Total</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Aluguel</ThBody>
                        <TdBody>2.500,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>ChatGPT</ThBody>
                        <TdBody>300,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>PetLove</ThBody>
                        <TdBody>231,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot></ThFoot>
                    <TdFoot></TdFoot>
                </template>
            </Table>
        </div>

        <div class="grid grid-cols-1 gap-10 xl:grid-cols-2">
            <div class="flex items-center justify-center">
                <PieChart />
            </div>

            <ColumnChart />
        </div>
    </div>
</template>
