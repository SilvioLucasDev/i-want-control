<script setup lang="ts">
defineProps({
    checked: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits<{
    (event: 'toggle', value: void): void;
}>();

const toggle = () => emit('toggle');
</script>

<template>
    <label class="inline-flex cursor-pointer items-center">
        <input type="checkbox" class="peer sr-only" :checked="checked" @change="toggle" />

        <div
            class="peer relative h-5 w-9 rounded-full bg-gray-900 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-900 after:bg-white after:transition-all after:content-[''] peer-checked:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-checked:bg-gray-600 dark:peer-focus:ring-gray-800 rtl:peer-checked:after:-translate-x-full"
        ></div>
    </label>
</template>
