<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import Select from '@/Components/Inputs/Select.vue';
import Modal from '@/Components/Modal/Modal.vue';

import debounce from 'lodash/debounce';
import { defineProps, onMounted, ref } from 'vue';

export type SelectDate = {
    month: number | null;
    year: number;
};

const props = defineProps<{ onlyYear?: boolean }>();

const emit = defineEmits<{ (event: 'selectDate', value: SelectDate): void }>();

const showModal = ref<boolean>(false);
const selectedMonthYear = ref<string>('');

const currentMonth = ref<number>(new Date().getMonth());
const currentYear = ref<number>(new Date().getFullYear());
const months = ref<string[]>(['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']);
const years = ref<number[]>(Array.from({ length: 51 }, (_, i) => 2025 + i));

const nextYear = (): void => {
    if (currentYear.value < years.value[years.value.length - 1]) {
        currentYear.value++;
        setMonthYear();
        selectDate();
    }
};

const previousYear = (): void => {
    if (currentYear.value > years.value[0]) {
        currentYear.value--;
        setMonthYear();
        selectDate();
    }
};

const nextMonth = (): void => {
    if (props.onlyYear) return;
    if (currentMonth.value === 11) {
        nextYear();
        currentMonth.value = 0;
    } else {
        currentMonth.value++;
    }
    setMonthYear();
    selectDate();
};

const previousMonth = (): void => {
    if (props.onlyYear) return;
    if (currentMonth.value === 0) {
        previousYear();
        currentMonth.value = 11;
    } else {
        currentMonth.value--;
    }
    setMonthYear();
    selectDate();
};

const setMonthYear = (): void => {
    selectedMonthYear.value = props.onlyYear ? `${currentYear.value}` : `${months.value[currentMonth.value]} / ${currentYear.value}`;
};

const selectDate: () => void = debounce(() => {
    emit('selectDate', props.onlyYear ? { month: null, year: currentYear.value } : { month: currentMonth.value + 1, year: currentYear.value });
}, 500);

onMounted(() => {
    setMonthYear();
});
</script>

<template>
    <div class="inline-flex w-80 items-center justify-between rounded-lg border border-gray-200 bg-white text-center text-sm font-medium text-gray-900 shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-white">
        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="onlyYear ? previousYear() : previousMonth()">
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
            </svg>
        </button>

        <button type="button" @click="showModal = true" class="mx-4 inline-flex items-center px-4 py-2 text-gray-900 dark:text-white">
            {{ selectedMonthYear }}
        </button>

        <button class="px-4 py-2 text-gray-900 transition duration-75 dark:text-white" @click="onlyYear ? nextYear() : nextMonth()">
            <svg class="h-5 w-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M8.59 16.59L10 18l6-6-6-6-1.41 1.41L13.17 12z" />
            </svg>
        </button>
    </div>

    <Modal :show="showModal" @close="showModal = false" max-width="sm">
        <div class="p-6">
            <h3 v-if="onlyYear" class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Selecione o ano</h3>
            <h3 v-else class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Selecione o mês e ano</h3>

            <Select id="yearSelect" class="mb-4" v-model="currentYear" label="Ano" :options="years.map((year) => ({ value: year, label: year.toString() }))" />

            <Select v-if="!onlyYear" id="monthSelect" class="mb-4" v-model="currentMonth" label="Mês" :options="months.map((month, index) => ({ value: index, label: month }))" />

            <div class="mt-4 grid grid-cols-2 gap-2">
                <PrimaryButton
                    class="mb-2 me-2 px-5"
                    @click="
                        () => {
                            setMonthYear();
                            selectDate();
                            showModal = false;
                        }
                    "
                >
                    Salvar
                </PrimaryButton>

                <SecondaryButton @click="showModal = false"> Cancelar </SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
