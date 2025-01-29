<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    class?: string;
    active?: boolean;
}>();

const classes = computed(() => ['w-3 h-3 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white', props.active ? 'bg-gray-200 text-gray-900 dark:bg-gray-600 dark:text-white' : '', props.class]);
</script>

<template>
    <svg :class="classes" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
</template>
