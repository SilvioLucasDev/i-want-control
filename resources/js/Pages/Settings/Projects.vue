<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';

import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

interface Project {
    id: number;
    name: string;
    isEditing: boolean;
}

const form = useForm({
    type: '',
});

const projects = ref<Project[]>([
    { id: 1, name: 'Wakami', isEditing: false },
    { id: 2, name: 'Gestione', isEditing: false },
    { id: 3, name: 'MFA', isEditing: false },
    { id: 4, name: 'IWantControl', isEditing: false },
    { id: 5, name: 'ABBA', isEditing: false },
]);

const submit = (): void => {
    console.log('Adicionando método de pagamento:', form.type);
    // if (!form.type.trim()) return;

    // form.post('/projects', {
    //     onSuccess: () => {
    //         projects.value.push({
    //             id: Date.now(),
    //             name: form.type.trim(),
    //             isEditing: false,
    //         });
    //         form.type = ''; // Limpa o input
    //     },
    // });
};

const toggleEdit = (project: Project): void => {
    project.isEditing = !project.isEditing;
};

const saveEdit = (project: Project): void => {
    project.isEditing = false;

    console.log('Salvando edição do método:', project.name);

    // form.put(`/projects/${project.id}`, {
    //     type: project.name,
    //     onSuccess: () => {
    //         console.log('Método atualizado com sucesso!');
    //     },
    // });
};

const removeProject = (projectId: number): void => {
    console.log('Removendo projeto:', projectId);
    // form.delete(`/projects/${projectId}`, {
    //     onSuccess: () => {
    //         projects.value = projects.value.filter((project) => project.id !== projectId);
    //     },
    // });
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput id="type" v-model="form.type" type="text" class="block w-full" placeholder="I Want Control" />
            <InputError class="mt-2" :message="form.errors.type" />
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

            <div class="flex space-x-2">
                <CheckIcon v-if="project.isEditing" @click="saveEdit(project)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(project)" class="cursor-pointer" />
                <TrashIcon @click="removeProject(project.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
