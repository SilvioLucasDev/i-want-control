<script setup lang="ts">
import { defineProps } from 'vue';

defineProps({
    title: String,
    text: String,
});
</script>

<template>
    <div class="flex items-center justify-between space-x-3 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div>
            <h5 class="text-sm font-bold text-gray-900 dark:text-white">{{ title }}</h5>
            <p class="text-lg text-gray-400">{{ text }}</p>
        </div>

        <slot />
    </div>
</template>
