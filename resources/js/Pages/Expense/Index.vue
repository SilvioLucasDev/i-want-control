<script setup lang="ts">
import Entries from '@/Pages/Expense/Entries/Entries.vue';
import Investments from '@/Pages/Expense/Investmnets/Investments.vue';
import Outputs from '@/Pages/Expense/Outputs/Outputs.vue';
import Results from '@/Pages/Expense/Results/Results.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import Tabs from '@/Components/Navigation/Tabs.vue';

const fetchData = ({ month, year }: SelectDate): void => {
    console.log(`GASTOS :: Fetching data for: ${month} / ${year}`);
};

const activeTab = ref('entries');

const setActiveTab = (tab: string): void => {
    activeTab.value = tab;
};
</script>

<template>
    <Head title="Gastos" />

    <Calendar @select-date="fetchData" />

    <Tabs
        :tabs="[
            { key: 'entries', label: 'Entradas' },
            { key: 'outputs', label: 'Saídas' },
            { key: 'investments', label: 'Investimentos' },
            { key: 'results', label: 'Resultados' },
        ]"
        @set-active-tab="setActiveTab"
    />

    <template v-if="activeTab === 'entries'">
        <Entries />
    </template>

    <template v-if="activeTab === 'outputs'">
        <Outputs />
    </template>

    <template v-if="activeTab === 'investments'">
        <Investments />
    </template>

    <template v-if="activeTab === 'results'">
        <Results />
    </template>
</template>
