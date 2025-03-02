<script setup lang="ts">
import ToggleInput from '@/Components/Inputs/ToggleInput.vue';

import { useEditMode } from '@/Composables/useEditMode';

const { isEditing, toggleEditMode } = useEditMode();
</script>

<template>
    <div class="group flex justify-between rounded-lg bg-gray-100 p-2 text-gray-900 transition duration-75 dark:bg-gray-700 dark:text-white">
        <div class="flex items-center">
            <span class="ms-3" v-if="!isEditing">Habilitar Edição</span>
            <span class="ms-3" v-else>Desabilitar Edição</span>
        </div>

        <ToggleInput :checked="isEditing" @toggle="toggleEditMode" />
    </div>
</template>
