<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useProjects } from '@/Composables/useProjects';
import { ref } from 'vue';

const { projects, addProject, updateProject, removeProject } = useProjects();

export interface Project {
    id: number;
    type: string;
    hourlyRate: string;
    isEditing: boolean;
}

const formType = ref('');
const formHourlyRate = ref('');

const save = async (): Promise<void> => {
    const result = await addProject({
        id: 0,
        type: formType.value,
        hourlyRate: formHourlyRate.value,
        isEditing: false,
    });

    if (result) {
        formType.value = '';
        formHourlyRate.value = '';
    }
};

const edit = async (project: Project): Promise<void> => {
    await updateProject(project);
};

const toggleEdit = (project: Project): void => {
    project.isEditing = !project.isEditing;
};

const remove = async (projectId: number): Promise<void> => {
    await removeProject(projectId);
};
</script>

<template>
    <form @submit.prevent="save" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput v-model="formType" type="text" class="block w-full" placeholder="Nome do Projeto" />
        </div>

        <div class="relative w-full pe-2">
            <TextInput v-model="formHourlyRate" type="text" class="block w-full" placeholder="Valor da Hora" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="project in projects" :key="project.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="project.isEditing" v-model="project.type" class="me-2 block w-full" />
            <TextInput v-if="project.isEditing" v-model="project.hourlyRate" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ project.type }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="project.isEditing" @click="edit(project)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(project)" class="cursor-pointer" />
                <TrashIcon @click="remove(project.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
