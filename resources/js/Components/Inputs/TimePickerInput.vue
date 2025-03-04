<script setup lang="ts">
import WatchIcon from '@/Components/Icons/WatchIcon.vue';

const model = defineModel<string>({ required: true });
</script>

<template>
    <div class="flex">
        <input
            v-model="model"
            type="time"
            class="block w-full flex-1 rounded-none rounded-s-lg border border-gray-300 p-2.5 text-sm leading-none focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:placeholder-gray-400 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
            max="23:59"
            value="00:00"
        />
        <span class="rounded-s-0 inline-flex items-center rounded-e-md border border-s-0 border-gray-300 bg-gray-200 px-3 text-sm dark:border-gray-700 dark:bg-gray-600 dark:text-gray-400">
            <WatchIcon />
        </span>
    </div>
</template>

<input class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600" v-model="model" ref="input" />
