<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import CheckIcon from '@/Components/Icons/CheckIcon.vue';
import PencilIcon from '@/Components/Icons/PencilIcon.vue';
import PlusIcon from '@/Components/Icons/PlusIcon.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import { usePaymentMethods } from '@/Composables/usePaymentMethods';

import { useForm } from '@inertiajs/vue3';

const { paymentMethods } = usePaymentMethods();

export interface PaymentMethod {
    id: number;
    name: string;
    isEditing: boolean;
}

const form = useForm({
    type: '',
});

const submit = (): void => {
    if (!form.type.trim()) return;

    form.post('/payment-methods', {
        onSuccess: () => {
            form.type = '';

            // AQUI EU ADICIONO O MÉTODO DE PAGAMENTO NO ARRAY
        },
    });
};

const toggleEdit = (method: PaymentMethod): void => {
    method.isEditing = !method.isEditing;
};

const saveEdit = (method: PaymentMethod): void => {
    method.isEditing = false;

    const editForm = useForm({
        name: method.name,
    });

    editForm.put(`/payment-methods/${method.id}`, {
        onSuccess: () => {
            // AQUI EU ATUALIZO O MÉTODO DE PAGAMENTO NO ARRAY
        },
    });
};

const removePaymentMethod = (methodId: number): void => {
    form.delete(`/payment-methods/${methodId}`, {
        onSuccess: () => {
            // AQUI EU REMOVO O MÉTODO DE PAGAMENTO DO ARRAY
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto flex items-center">
        <div class="relative w-full pe-2">
            <TextInput id="type" v-model="form.type" type="text" class="block w-full" placeholder="Tipo do Método de Pagamento" />
            <InputError class="mt-2" :message="form.errors.type" />
        </div>

        <PrimaryButton type="submit" class="flex h-10 items-center sm:px-5">
            <PlusIcon class="h-3 w-3 text-white dark:text-gray-900" />
            <span class="hidden ps-2 sm:flex"> Adicionar </span>
        </PrimaryButton>
    </form>

    <ul class="mt-4 divide-y divide-gray-200 rounded-lg border border-gray-300 bg-white shadow dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">
        <li v-for="method in paymentMethods" :key="method.id" class="flex items-center justify-between px-4 py-3">
            <TextInput v-if="method.isEditing" v-model="method.name" class="me-2 block w-full" />
            <span v-else class="text-gray-900 dark:text-white">{{ method.name }}</span>

            <div class="flex space-x-2">
                <CheckIcon v-if="method.isEditing" @click="saveEdit(method)" class="cursor-pointer" />
                <PencilIcon v-else @click="toggleEdit(method)" class="cursor-pointer" />
                <TrashIcon @click="removePaymentMethod(method.id)" class="cursor-pointer" />
            </div>
        </li>
    </ul>
</template>
