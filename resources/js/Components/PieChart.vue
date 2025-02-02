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
    <div class="w-full max-w-sm rounded-lg bg-white p-4 shadow-sm dark:bg-gray-800 md:p-6">
        <div class="mb-1 flex items-center justify-center">
            <h5 class="me-1 text-xl font-bold leading-none text-gray-900 dark:text-white">Resumo Financeiro</h5>

            <svg class="h-4 w-4 cursor-pointer text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"
                />
            </svg>
        </div>

        <div id="pie-chart" class="mt-4"></div>
    </div>
</template>
