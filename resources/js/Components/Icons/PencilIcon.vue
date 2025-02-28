<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
    active: Boolean,
});

const classes = computed(() => ['h-6 w-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white', props.active ? 'bg-gray-200 text-gray-900 dark:bg-gray-600 dark:text-white' : '', props.class]);
</script>

<template>
    <svg :class="classes" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"
        />
    </svg>
</template>
