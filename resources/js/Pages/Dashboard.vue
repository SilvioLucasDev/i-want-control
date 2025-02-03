<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import Calendar, { SelectDate } from '@/Components/Calendar.vue';

const fetchData = ({ month, year }: SelectDate): void => {
    console.log(`DASHBOARD :: Fetching data for: ${month} / ${year}`);
};
</script>

<template>
    <Head title="Dashboard" />

    <Calendar @select-date="fetchData" />
</template>
