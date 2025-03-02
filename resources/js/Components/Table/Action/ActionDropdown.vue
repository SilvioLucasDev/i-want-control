<script setup lang="ts">
import { nextTick, onMounted, onUnmounted, ref } from 'vue';

const show = ref(false);
const dropdown = ref<HTMLElement | null>(null);
const button = ref<HTMLElement | null>(null);
const dropdownStyles = ref({ top: '0px', left: '0px' });

const toggleDropdown = async () => {
    show.value = !show.value;

    if (show.value) {
        await nextTick();
        positionDropdown();
    }
};

const positionDropdown = () => {
    if (button.value && dropdown.value) {
        const buttonRect = button.value.getBoundingClientRect();

        dropdownStyles.value = {
            top: `${buttonRect.bottom + window.scrollY}px`,
            left: `${buttonRect.left + window.scrollX - 60}px`,
        };
    }
};

const handleClickOutside = (event: MouseEvent) => {
    if (dropdown.value && button.value && !dropdown.value.contains(event.target as Node) && !button.value.contains(event.target as Node)) {
        show.value = false;
    }
};

onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <div class="inline-block">
        <button ref="button" @click="toggleDropdown" class="inline-flex items-center rounded-lg p-2 text-gray-500 hover:text-gray-800 focus:outline-none dark:text-gray-400 dark:hover:text-gray-100">
            <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
            </svg>
        </button>

        <div v-if="show" ref="dropdown" class="fixed z-50 w-36 rounded bg-white shadow-lg dark:bg-gray-700" :style="dropdownStyles">
            <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                <slot />
            </ul>
        </div>
    </div>
</template>
