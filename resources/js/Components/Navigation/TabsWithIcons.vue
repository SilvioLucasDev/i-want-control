<script setup lang="ts">
import { PropType, ref } from 'vue';

const props = defineProps({
    tabs: {
        type: Array as PropType<{ key: string; label: string }[]>,
        required: true,
    },
});

const emit = defineEmits<{
    (event: 'setActiveTab', value: string): void;
}>();

const activeTab = ref(props.tabs[0].key);

const setActiveTab = (tab: string): void => {
    activeTab.value = tab;
    emit('setActiveTab', tab);
};
</script>

<template>
    <!-- Mobile Scrollable Tabs -->
    <ul class="mb-4 flex overflow-x-auto whitespace-nowrap border-b border-gray-200 text-sm font-medium text-gray-500 dark:border-gray-700 dark:text-gray-400 sm:hidden">
        <li v-for="tab in tabs" :key="tab.key" class="mr-2">
            <button
                @click="setActiveTab(tab.key)"
                class="border-b-2 px-4 py-2 transition duration-150 ease-in-out"
                :class="{
                    'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500': tab.key === activeTab,
                    'border-transparent hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300': tab.key !== activeTab,
                }"
            >
                {{ tab.label }}
            </button>
        </li>
    </ul>

    <!-- Desktop Navigation -->
    <ul class="mb-4 hidden border-b border-gray-200 text-sm font-medium text-gray-500 dark:border-gray-700 dark:text-gray-400 sm:flex">
        <li v-for="tab in tabs" :key="tab.key" class="mr-2">
            <button
                @click="setActiveTab(tab.key)"
                class="border-b-2 px-4 py-2 transition duration-150 ease-in-out"
                :class="{
                    'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500': tab.key === activeTab,
                    'border-transparent hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300': tab.key !== activeTab,
                }"
            >
                {{ tab.label }}
            </button>
        </li>
    </ul>
</template>
