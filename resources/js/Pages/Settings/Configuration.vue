<script setup lang="ts">
import { useEditMode } from '@/Composables/useEditMode';

const { isEditing, toggleEditMode } = useEditMode();
</script>

<template>
    <div class="group flex justify-between rounded-lg bg-gray-100 p-2 text-gray-900 transition duration-75 dark:bg-gray-700 dark:text-white">
        <div class="flex items-center">
            <span class="ms-3" v-if="!isEditing">Habilitar Edição</span>
            <span class="ms-3" v-else>Desabilitar Edição</span>
        </div>

        <label class="inline-flex cursor-pointer items-center">
            <input type="checkbox" class="peer sr-only" :checked="isEditing" @change="toggleEditMode" />
            <div
                class="peer relative h-5 w-9 rounded-full bg-gray-900 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-900 after:bg-white after:transition-all after:content-[''] peer-checked:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-checked:bg-gray-600 dark:peer-focus:ring-gray-800 rtl:peer-checked:after:-translate-x-full"
            ></div>
        </label>
    </div>
</template>
