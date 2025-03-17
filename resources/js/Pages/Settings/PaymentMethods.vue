<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';

import { usePaymentMethods } from '@/Composables/usePaymentMethods';
import { ref } from 'vue';

const { paymentMethods, addPaymentMethod, updatePaymentMethod, removePaymentMethod } = usePaymentMethods();

export type PaymentMethod = {
    id: number;
    type: string;
    isEditing: boolean;
};

const formType = ref('');

const save = async (): Promise<void> => {
    await addPaymentMethod({ id: 0, type: formType.value, isEditing: false });
    formType.value = '';
};

const edit = async (method: PaymentMethod): Promise<void> => {
    await updatePaymentMethod(method);
};

const toggleEdit = (method: PaymentMethod): void => {
    method.isEditing = !method.isEditing;
};

const remove = async (methodId: number): Promise<void> => {
    await removePaymentMethod(methodId);
};
</script>

<template>
    <form @submit.prevent="save" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput v-model="formType" type="text" class="block w-full" placeholder="Tipo do Método de Pagamento" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="method in paymentMethods" :key="method.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="method.isEditing" v-model="method.type" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ method.type }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="method.isEditing" @click="edit(method)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(method)" class="cursor-pointer" />
                <TrashIcon @click="remove(method.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
