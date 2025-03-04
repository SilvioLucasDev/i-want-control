<script setup lang="ts">
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import Tabs from '@/Components/Navigation/Tabs.vue';
import General from '@/Pages/Dashboard/General.vue';
import Investments from '@/Pages/Dashboard/Investments.vue';

import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const fetchData = ({ year }: SelectDate): void => {
    console.log(`DASHBOARD :: Fetching data for: ${year}`);
};

const activeTab = ref<string>('general');

const setActiveTab = (tab: string): void => {
    activeTab.value = tab;
};
</script>

<template>
    <Head title="Dashboard" />

    <Calendar @select-date="fetchData" onlyYear />

    <Tabs
        :tabs="[
            { key: 'general', label: 'Geral' },
            { key: 'investments', label: 'Investimentos' },
        ]"
        @set-active-tab="setActiveTab"
    />
    <template v-if="activeTab === 'general'">
        <General />
    </template>

    <template v-if="activeTab === 'investments'">
        <Investments />
    </template>
</template>
