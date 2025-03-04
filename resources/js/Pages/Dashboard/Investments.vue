<script setup lang="ts">
import ColumnChart from '@/Components/ColumnChart.vue';
import DashboardCard from '@/Components/DashboardCard.vue';
import ArrowUpRightIcon from '@/Components/Icons/ArrowUpRightIcon.vue';
import CashRegisterIcon from '@/Components/Icons/CashRegisterIcon.vue';
import ChartDolarIcon from '@/Components/Icons/ChartDolarIcon.vue';
import DolarIcon from '@/Components/Icons/DolarIcon.vue';
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
        <div class="grid grid-cols-1 gap-10 lg:grid-cols-4">
            <DashboardCard title="Total Investido" text="R$ 1.200,00">
                <DolarIcon />
            </DashboardCard>

            <DashboardCard title="Total de Rendimentos" text="R$ 1.200,00">
                <ChartDolarIcon />
            </DashboardCard>

            <DashboardCard title="Total Resgatado" text="R$ 1.200,00">
                <ArrowUpRightIcon />
            </DashboardCard>

            <DashboardCard title="Saldo Final" text="R$ 1.200,00">
                <CashRegisterIcon />
            </DashboardCard>
        </div>

        <div>
            <Table>
                <template #header>
                    Principais Rendimentos
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Cálculo total dos principais rendimentos.</p>
                </template>

                <template #thead>
                    <ThHead class="text-start">Tipo</ThHead>
                    <ThHead>Total</ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>FII</ThBody>
                        <TdBody>2.500,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Criptomoeda</ThBody>
                        <TdBody>300,00</TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Renda Variável</ThBody>
                        <TdBody>231,00</TdBody>
                    </TrBody>
                </template>

                <template #tfoot>
                    <ThFoot></ThFoot>
                    <TdFoot></TdFoot>
                </template>
            </Table>
        </div>

        <div>
            <ColumnChart />
        </div>
    </div>
</template>
