<script setup lang="ts">
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import { Head } from '@inertiajs/vue3';

const fetchData = ({ month, year }: SelectDate) => {
    console.log(`GASTOS :: Fetching data for: ${month} / ${year}`);
};
</script>

<template>
    <Head title="Gastos" />

    <Calendar @select-date="fetchData" />
</template>
