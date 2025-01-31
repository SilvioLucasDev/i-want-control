<script setup lang="ts">
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import { Head } from '@inertiajs/vue3';

const fetchData = ({ month, year }: SelectDate) => {
    console.log(`SERVICES :: Fetching data for: ${month} / ${year}`);
};
</script>

<template>
    <Head title="Serviços" />

    <Calendar @select-date="fetchData" />
</template>
