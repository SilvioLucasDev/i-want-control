<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useInvestmentType } from '@/Composables/useInvestment';

import { useForm } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const { fetchInvestments, isInvestments } = useInvestmentType();

export interface Investment {
    id: number;
    name: string;
    income: string;
    isEditing: boolean;
}

const investments = ref<Investment[]>([]);

const form = useForm({
    type: '',
    income: '',
});

const loadInvestments = async () => {
    await fetchInvestments();
    investments.value = isInvestments.value;
};

onMounted(() => {
    loadInvestments();
});

const submit = (): void => {
    if (!form.type.trim()) return;

    form.post('/investments', {
        onSuccess: () => {
            form.type = '';
            form.income = '';

            loadInvestments();
        },
    });
};

const toggleEdit = (investment: Investment): void => {
    investment.isEditing = !investment.isEditing;
};

const saveEdit = (investment: Investment): void => {
    investment.isEditing = false;

    const editForm = useForm({
        name: investment.name,
        income: investment.income,
    });

    editForm.put(`/investments/${investment.id}`, {
        onSuccess: () => {
            loadInvestments();
        },
    });
};

const removeInvestment = (investmentId: number): void => {
    form.delete(`/investments/${investmentId}`, {
        onSuccess: () => {
            loadInvestments();
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput id="type" v-model="form.type" type="text" class="block w-full" placeholder="Tipo de Investimento" />
            <InputError class="mt-2" :message="form.errors.type" />
        </div>
        <div class="relative w-full pe-2">
            <TextInput id="income" v-model="form.income" type="text" class="block w-full" placeholder="Rendimento" />
            <InputError class="mt-2" :message="form.errors.income" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="investment in investments" :key="investment.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="investment.isEditing" v-model="investment.name" class="me-2 block w-full" />
            <TextInput v-if="investment.isEditing" v-model="investment.income" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ investment.name }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="investment.isEditing" @click="saveEdit(investment)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(investment)" class="cursor-pointer" />
                <TrashIcon @click="removeInvestment(investment.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
