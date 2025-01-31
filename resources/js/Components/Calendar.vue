<script setup lang="ts">
import debounce from 'lodash/debounce';

import { onMounted, ref } from 'vue';
import PrimaryButton from './PrimaryButton.vue';
import SecondaryButton from './SecondaryButton.vue';
import Select from './Select.vue';

const showModal = ref(false);

const currentMonth = ref();
const currentYear = ref();
const selectedMonthYear = ref('');
const months = ref<string[]>([]);
const years = ref<number[]>([]);

const nextMonth = () => {
    if (currentMonth.value === 11) {
        if (currentYear.value === years.value[years.value.length - 1]) return;

        currentMonth.value = 0;
        currentYear.value++;
    } else {
        currentMonth.value++;
    }
    setMonthYear();
    fetchData();
};

const previousMonth = () => {
    if (currentMonth.value === 0) {
        if (currentYear.value === years.value[0]) return;
        currentYear.value--;
        currentMonth.value = 11;
    } else {
        currentMonth.value--;
    }

    setMonthYear();
    fetchData();
};

const setDate = () => {
    months.value = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    years.value = Array.from({ length: 51 }, (_, i) => 2025 + i);

    const now = new Date();
    currentMonth.value = now.getMonth();
    currentYear.value = now.getFullYear();

    setMonthYear();
};

const setMonthYear = () => {
    selectedMonthYear.value = `${months.value[currentMonth.value]} / ${currentYear.value}`;
};

const fetchData = debounce(() => {
    console.log(`Fetching data for: ${months.value[currentMonth.value]} / ${currentYear.value}`);
}, 500);

onMounted(() => {
    setDate();
    fetchData();
});
</script>

<template>
    <div class="inline-flex w-80 items-center justify-between rounded-lg border border-gray-200 bg-white text-center text-sm font-medium text-gray-900 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="previousMonth">
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>

        <button type="button" @click="showModal = true" class="mx-4 inline-flex items-center px-4 py-2 text-gray-900 dark:text-white">
            {{ selectedMonthYear }}
        </button>

        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="nextMonth">
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z" />
            </svg>
        </button>
    </div>

    <div v-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-50"></div>

    <div v-show="showModal" id="timepicker-modal" tabindex="-1" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden">
        <div class="relative max-h-full w-full max-w-[23rem] p-4">
            <div class="relative rounded-lg bg-white shadow-sm dark:bg-gray-800">
                <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Selecione o mês e ano</h3>
                    <button
                        type="button"
                        class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="showModal = false"
                    >
                        <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar</span>
                    </button>
                </div>

                <div class="p-4">
                    <Select id="year-select" class="mb-4" v-model="currentYear" label="Ano" :options="years.map((year) => ({ value: year, label: year.toString() }))" />

                    <Select id="month-select" class="mb-4" v-model="currentMonth" label="Mês" :options="months.map((month, index) => ({ value: index, label: month }))" />

                    <div class="grid grid-cols-2 gap-2">
                        <PrimaryButton
                            @click="
                                () => {
                                    setMonthYear();
                                    fetchData();
                                    showModal = false;
                                }
                            "
                        >
                            Salvar
                        </PrimaryButton>

                        <SecondaryButton @click="showModal = false"> Cancel </SecondaryButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
