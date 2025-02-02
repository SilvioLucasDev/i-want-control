<script setup lang="ts">
import { onMounted, PropType, ref } from 'vue';

const model = defineModel<string | number>({ required: true });

const selectRef = ref<HTMLSelectElement | null>(null);

onMounted(() => {
    if (selectRef.value?.hasAttribute('autofocus')) {
        selectRef.value.focus();
    }
});

defineProps({
    options: Array as PropType<{ value: string | number; label: string }[]>,
    id: String,
    label: String,
    screenReaderOnly: Boolean,
});

defineExpose({ focus: () => selectRef.value?.focus() });
</script>

<template>
    <div>
        <label v-if="label" :for="id" :class="['mb-2 block text-sm font-medium text-gray-900 dark:text-white', { 'sr-only': screenReaderOnly }]">
            {{ label }}
        </label>

        <select :id="id" v-model="model" ref="selectRef" class="block w-full rounded-lg border border-gray-300 dark:bg-gray-700 dark:text-white">
            <option v-for="option in options" :key="option.value" :value="option.value">
                {{ option.label }}
            </option>
        </select>
    </div>
</template>
