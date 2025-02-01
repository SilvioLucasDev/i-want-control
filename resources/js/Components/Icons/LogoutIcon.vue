<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
    active: Boolean,
});

const classes = computed(() => [
    'shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white',
    props.active ? 'bg-gray-200 text-gray-900 dark:bg-gray-600 dark:text-white' : '',
    props.class,
]);
</script>

<template>
    <svg :class="classes" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
    </svg>
</template>
