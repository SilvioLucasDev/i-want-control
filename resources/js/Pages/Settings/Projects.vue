<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useProjectType } from '@/Composables/useProject';

import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const { fetchProjects, isProjects } = useProjectType();

export interface Project {
    id: number;
    name: string;
    hourlyRate: string;
    isEditing: boolean;
}

const projects = ref<Project[]>([]);

const loadProjects = async () => {
    await fetchProjects();
    projects.value = isProjects.value;
};

onMounted(() => {
    loadProjects();
});

const form = useForm({
    type: '',
    hourlyRate: '',
});

const submit = (): void => {
    if (!form.type.trim()) return;

    form.post('/projects', {
        onSuccess: () => {
            form.type = '';
            form.hourlyRate = '';

            loadProjects();
        },
    });
};

const toggleEdit = (project: Project): void => {
    project.isEditing = !project.isEditing;
};

const saveEdit = (project: Project): void => {
    project.isEditing = false;

    const editForm = useForm({
        name: project.name,
        hourlyRate: project.hourlyRate,
    });

    editForm.put(`/projects/${project.id}`, {
        onSuccess: () => {
            loadProjects();
        },
    });
};

const removeProject = (projectId: number): void => {
    form.delete(`/projects/${projectId}`, {
        onSuccess: () => {
            loadProjects();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput id="type" v-model="form.type" type="text" class="block w-full" placeholder="Nome do Projeto" />
            <InputError class="mt-2" :message="form.errors.type" />
        </div>

        <div class="relative w-full pe-2">
            <TextInput id="hourlyRate" v-model="form.hourlyRate" type="text" class="block w-full" placeholder="Valor da Hora" />
            <InputError class="mt-2" :message="form.errors.hourlyRate" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="project in projects" :key="project.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="project.isEditing" v-model="project.name" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ project.name }}</span>
            <TextInput v-if="project.isEditing" v-model="project.hourlyRate" class="me-2 block w-full" />

            <div class="flex space-x-2">
                <CheckIcon v-if="project.isEditing" @click="saveEdit(project)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(project)" class="cursor-pointer" />
                <TrashIcon @click="removeProject(project.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
