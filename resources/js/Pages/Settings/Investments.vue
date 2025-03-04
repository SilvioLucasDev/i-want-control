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

interface Investment {
    id: number;
    type: string;
    income: string | null;
    isEditing: boolean;
}

const form = useForm({
    type: '',
});

const investments = ref<Investment[]>([
    { id: 1, type: 'FII', income: '1%', isEditing: false },
    { id: 2, type: 'Criptomoeda', income: null, isEditing: false },
    { id: 3, type: 'Renda Fixa', income: '0.9%', isEditing: false },
    { id: 4, type: 'Tesouro', income: '2%', isEditing: false },
]);

const submit = (): void => {
    console.log('Adicionando novo investimento:', form.type);
    // if (!form.type.trim()) return;

    // form.post('/investments', {
    //     onSuccess: () => {
    //         investments.value.push({
    //             id: Date.now(),
    //             type: form.type.trim(),
    //             isEditing: false,
    //         });
    //         form.type = ''; // Limpa o input
    //     },
    // });
};

const toggleEdit = (investment: Investment): void => {
    investment.isEditing = !investment.isEditing;
};

const saveEdit = (investment: Investment): void => {
    investment.isEditing = false;

    console.log('Salvando edição do investimento:', investment.type);

    // form.put(`/investments/${investment.id}`, {
    //     type: investment.type,
    //     onSuccess: () => {
    //         console.log('Método atualizado com sucesso!');
    //     },
    // });
};

const removeInvestment = (investmentId: number): void => {
    console.log('Removendo investmento:', investmentId);

    // form.delete(`/investments/${investmentId}`, {
    //     onSuccess: () => {
    //         investments.value = investments.value.filter((investment) => investment.id !== investmentId);
    //     },
    // });
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput id="type" v-model="form.type" type="text" class="block w-full" placeholder="Investimento" />
            <InputError class="mt-2" :message="form.errors.type" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="investment in investments" :key="investment.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="investment.isEditing" v-model="investment.type" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ investment.type }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="investment.isEditing" @click="saveEdit(investment)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(investment)" class="cursor-pointer" />
                <TrashIcon @click="removeInvestment(investment.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
