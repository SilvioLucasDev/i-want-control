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
    <!-- Dropdown for Mobile -->
    <div class="sm:hidden">
        <label for="tab-select" class="sr-only">Selecione uma opção</label>
        <select id="tab-select" v-model="activeTab" @change="setActiveTab(activeTab)" class="block w-full rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
            <option v-for="tab in tabs" :key="tab.key" :value="tab.key">
                {{ tab.label }}
            </option>
        </select>
    </div>

    <!-- Desktop Navigation -->
    <ul class="hidden rounded-lg border border-gray-200 text-center text-sm font-medium text-gray-500 shadow-sm dark:divide-gray-700 dark:border-gray-700 dark:text-gray-400 sm:flex">
        <li v-for="(tab, index) in tabs" :key="tab.key" class="w-full focus-within:z-10">
            <button
                @click="setActiveTab(tab.key)"
                :class="[
                    'inline-block w-full border-gray-200 px-4 py-2 dark:border-gray-700',
                    tab.key === activeTab ? 'bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white' : 'bg-white hover:bg-gray-50 hover:text-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white',
                    index === 0 ? 'rounded-s-lg' : '',
                    index === tabs.length - 1 ? 'rounded-e-lg' : '',
                    index !== tabs.length - 1 ? 'border-r' : '',
                ]"
            >
                {{ tab.label }}
            </button>
        </li>
    </ul>
</template>
