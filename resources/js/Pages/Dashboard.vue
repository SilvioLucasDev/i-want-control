<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const selectedMonthYear = ref(''); // Valor inicial
const months = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
const years = Array.from({ length: 101 }, (_, i) => 2025 + i); // Anos de 2020 a 2125

// Obtém o mês e o ano atuais
const now = new Date();
const currentMonth = ref(now.getMonth()); // Índice do mês atual (0 = Janeiro)
const currentYear = ref(now.getFullYear()); // Ano atual

// Atualiza o texto do mês/ano exibido
const setMonthYear = () => {
    selectedMonthYear.value = `${months[currentMonth.value]} / ${currentYear.value}`;
};

// Função que simula o fetch de dados
const fetchData = () => {
    console.log(`Fetching data for: ${months[currentMonth.value]} / ${currentYear.value}`);
};

// Avança para o próximo mês
const nextMonth = () => {
    if (currentMonth.value === 11) {
        currentMonth.value = 0; // Vai para Janeiro
        currentYear.value++; // Incrementa o ano
    } else {
        currentMonth.value++;
    }
    setMonthYear();
    fetchData(); // Chama a função ao navegar pelas setas
};

// Volta para o mês anterior
const previousMonth = () => {
    if (currentMonth.value === 0) {
        currentMonth.value = 11; // Vai para Dezembro
        currentYear.value--; // Decrementa o ano
    } else {
        currentMonth.value--;
    }
    setMonthYear();
    fetchData(); // Chama a função ao navegar pelas setas
};

// Define o valor inicial ao carregar
setMonthYear();
</script>

<template>
    <Head title="Dashboard" />

    <!-- Botão com setas para exibir o modal -->
    <div class="inline-flex w-80 items-center justify-between rounded-lg border border-gray-200 bg-white text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="previousMonth">
            <!-- Ícone de seta para a esquerda -->
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>

        <button type="button" data-modal-target="timepicker-modal" data-modal-toggle="timepicker-modal" class="mx-4 inline-flex items-center px-4 py-2 text-gray-900 dark:text-white">
            {{ selectedMonthYear }}
        </button>

        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="nextMonth">
            <!-- Ícone de seta para a direita -->
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z" />
            </svg>
        </button>
    </div>

    <!-- Modal -->
    <div id="timepicker-modal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
        <div class="relative max-h-full w-full max-w-[23rem] p-4">
            <!-- Conteúdo do modal -->
            <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-800">
                <!-- Cabeçalho -->
                <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Selecione o mês e ano</h3>
                    <button
                        type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="timepicker-modal"
                    >
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar</span>
                    </button>
                </div>

                <!-- Corpo -->
                <div class="p-4">
                    <!-- Seleção de Ano -->
                    <div class="mb-4">
                        <label for="year-select" class="block text-sm font-medium text-gray-900 dark:text-white">Ano</label>
                        <select id="year-select" v-model="currentYear" class="block w-full rounded-lg border border-gray-300 p-2 dark:bg-gray-700 dark:text-white">
                            <option v-for="year in years" :key="year" :value="year">{{ year }}</option>
                        </select>
                    </div>

                    <!-- Seleção de Mês -->
                    <div class="mb-4">
                        <label for="month-select" class="block text-sm font-medium text-gray-900 dark:text-white">Mês</label>
                        <select id="month-select" v-model="currentMonth" class="block w-full rounded-lg border border-gray-300 p-2 dark:bg-gray-700 dark:text-white">
                            <option v-for="(month, index) in months" :key="index" :value="index">{{ month }}</option>
                        </select>
                    </div>

                    <!-- Botões -->
                    <div class="grid grid-cols-2 gap-2">
                        <button
                            type="button"
                            class="mb-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            @click="
                                () => {
                                    setMonthYear();
                                    fetchData();
                                }
                            "
                            data-modal-hide="timepicker-modal"
                        >
                            Salvar
                        </button>
                        <button
                            type="button"
                            data-modal-hide="timepicker-modal"
                            class="mb-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
                        >
                            Cancelar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
