<script setup lang="ts">
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import { Head } from '@inertiajs/vue3';

const fetchData = ({ month, year }: SelectDate) => {
    console.log(`DASHBOARD :: Fetching data for: ${month} / ${year}`);
};
</script>

<template>
    <Head title="Dashboard" />

    <Calendar @select-date="fetchData" />
</template>
