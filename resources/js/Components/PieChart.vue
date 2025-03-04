<script setup lang="ts">
import ApexCharts from 'apexcharts';
import { onMounted, ref } from 'vue';

// Configuração do gráfico
const chartOptions = ref({
    series: [52.8, 26.8, 20.4],
    colors: ['#1C64F2', '#16BDCA', '#9061F9'],
    chart: {
        height: 420,
        width: '100%',
        type: 'pie',
    },
    stroke: {
        colors: ['white'],
    },
    plotOptions: {
        pie: {
            labels: {
                show: true,
            },
            size: '100%',
            dataLabels: {
                offset: -25,
            },
        },
    },
    labels: ['Direct', 'Organic search', 'Referrals'],
    dataLabels: {
        enabled: true,
        style: {
            fontFamily: 'Inter, sans-serif',
        },
    },
    legend: {
        position: 'bottom',
        fontFamily: 'Inter, sans-serif',
    },
    yaxis: {
        labels: {
            formatter: (value: number) => `${value}%`,
        },
    },
    xaxis: {
        labels: {
            formatter: (value: number) => `${value}%`,
        },
        axisTicks: { show: false },
        axisBorder: { show: false },
    },
});

// Renderizar gráfico ao montar o componente
onMounted(() => {
    const chart = new ApexCharts(document.getElementById('pie-chart'), chartOptions.value);
    chart.render();
});
</script>

<template>
    <div class="w-full rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
        <div class="bg-white text-lg font-semibold text-gray-900 dark:bg-gray-800 dark:text-white">
            Resumo Financeiro
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Distribuição das despesas e receitas deste mês.</p>
        </div>

        <div id="pie-chart" class="mt-4"></div>
    </div>
</template>
