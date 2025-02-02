<script setup lang="ts">
import ArrowDownIcon from '@/Components/Icons/ArrowDownIcon.vue';
import ArrowUpIcon from '@/Components/Icons/ArrowUpIcon.vue';
import ControlIcon from '@/Components/Icons/ControlIcon.vue';
import NavLink from '@/Components/Navigation/NavLink.vue';
import { PropType, ref } from 'vue';

defineProps({
    title: String,
    links: Array as PropType<{ label: string; routeName: string }[]>,
});

const isOpen = ref(false);

const toggleDropdown = () => {
    isOpen.value = !isOpen.value;
};
</script>

<template>
    <li>
        <button type="button" :aria-expanded="isOpen" @click="toggleDropdown" class="group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
            <ControlIcon />
            <span class="ms-3 flex-1 whitespace-nowrap text-left rtl:text-right">{{ title }}</span>
            <ArrowUpIcon v-show="isOpen" />
            <ArrowDownIcon v-show="!isOpen" />
        </button>
        <ul v-show="isOpen" class="space-y-2 py-2">
            <li v-for="(link, index) in links" :key="index">
                <NavLink :href="route(link.routeName)" class="group flex w-full items-center rounded-lg p-2 pl-11 text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    {{ link.label }}
                </NavLink>
            </li>
        </ul>
    </li>
</template>
