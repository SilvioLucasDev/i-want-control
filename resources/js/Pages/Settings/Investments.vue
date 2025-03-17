<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { useInvestments } from '@/Composables/useInvestments';

import { ref } from 'vue';

const { investments, addInvestment, updateInvestment, removeInvestment } = useInvestments();

export interface Investment {
    id: number;
    type: string;
    income: string;
    isEditing: boolean;
}

const formType = ref('');
const formIncome = ref('');

const save = async (): Promise<void> => {
    const result = await addInvestment({ id: 0, type: formType.value, income: formIncome.value, isEditing: false });

    if (result) {
        formType.value = '';
        formIncome.value = '';
    }
};

const edit = async (investment: Investment): Promise<void> => {
    await updateInvestment(investment);
};

const toggleEdit = (investment: Investment): void => {
    investment.isEditing = !investment.isEditing;
};

const remove = async (investmentId: number): Promise<void> => {
    await removeInvestment(investmentId);
};
</script>

<template>
    <form @submit.prevent="save" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput v-model="formType" type="text" class="block w-full" placeholder="Nome do Investimento" />
        </div>
        <div class="relative w-full pe-2">
            <TextInput v-model="formIncome" type="text" class="block w-full" placeholder="Rendimento" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="investment in investments" :key="investment.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="investment.isEditing" v-model="investment.type" class="me-2 block w-full" />
            <TextInput v-if="investment.isEditing" v-model="investment.income" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ investment.type }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="investment.isEditing" @click="edit(investment)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(investment)" class="cursor-pointer" />
                <TrashIcon @click="remove(investment.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
