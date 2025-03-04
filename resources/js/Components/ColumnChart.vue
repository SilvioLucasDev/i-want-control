<script setup lang="ts">
import ApexCharts from 'apexcharts';
import { onMounted, ref } from 'vue';

// Configuração do gráfico de barras
const barChartOptions = ref({
    series: [
        {
            name: 'Despesas',
            color: '#1A56DB',
            data: [1200, 1500, 1100, 1800, 2000, 1300, 1400, 1600, 1700, 1900, 2100, 2300],
        },
        {
            name: 'Receitas',
            color: '#FDBA8C',
            data: [2000, 2200, 1800, 2500, 2700, 2100, 2300, 2400, 2600, 2800, 3000, 3200],
        },
    ],
    chart: {
        type: 'bar',
        height: '320px',
        fontFamily: 'Inter, sans-serif',
        toolbar: { show: false },
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '70%',
            borderRadiusApplication: 'end',
            borderRadius: 8,
        },
    },
    legend: {
        show: true,
        position: 'top',
        horizontalAlign: 'left',
    },
    xaxis: {
        floating: false,
        labels: {
            show: true,
            style: {
                fontFamily: 'Inter, sans-serif',
                cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400',
            },
        },
        axisBorder: {
            show: false,
        },
        axisTicks: {
            show: false,
        },
        categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    },
    yaxis: {
        labels: {
            formatter: (value: number) => `R$ ${value}`,
        },
    },
    fill: {
        opacity: 1,
    },
});
onMounted(() => {
    const barChart = new ApexCharts(document.getElementById('bar-chart'), barChartOptions.value);
    barChart.render();
});
</script>

<template>
    <div class="w-full rounded-lg bg-white p-6 shadow-sm dark:bg-gray-800">
        <div class="bg-white text-lg font-semibold text-gray-900 dark:bg-gray-800 dark:text-white">
            Evolução Mensal
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Comparação de receitas e despesas mês a mês.</p>
        </div>
        <div id="bar-chart" class="mt-4"></div>
    </div>
</template>
