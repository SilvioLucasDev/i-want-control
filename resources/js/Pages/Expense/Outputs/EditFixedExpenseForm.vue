<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import Checkbox from '@/Components/Inputs/Checkbox.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import Select from '@/Components/Inputs/Select.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import ConfirmDeleteModal from '@/Components/Modal/ConfirmDeleteModal.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useForm } from '@inertiajs/vue3';
import { PropType, ref, watch } from 'vue';

const props = defineProps({
    showEditFixedExpenseModal: Boolean,
    item: Object as PropType<{ id: number; type: string; paymentType: string; value: string; recurrent?: boolean } | null>,
});

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const form = useForm({
    id: props.item?.id ?? 0,
    type: props.item?.type ?? '',
    paymentType: props.item?.paymentType ?? '',
    value: props.item?.value ?? '',
    recurrent: props.item?.recurrent ?? false,
});

watch(
    () => props.item,
    (newItem) => {
        if (newItem) {
            form.id = newItem.id ?? 0;
            form.type = newItem.type ?? '';
            form.paymentType = newItem.paymentType ?? '';
            form.value = newItem.value ?? '';
            form.recurrent = newItem.recurrent ?? false;
        }
    },
    { deep: true, immediate: true },
);

const edit = (): void => {
    console.log('DASHBOARD :: Edit Fixed Expense', form);
};

const modals = ref({
    confirmDeleteModal: false,
});

const toggleModal = (type: 'confirmDeleteModal') => {
    modals.value[type] = !modals.value[type];
};

const deleteItem = () => {
    console.log(`Deletar item: ${form.id}`);

    toggleModal('confirmDeleteModal');
};

const paymentTypeMock = ref<string[]>(['Dinheiro', 'Débito', 'Crédito', 'Nubank', 'C6', 'Itaú']);
</script>

<template>
    <Modal :show="showEditFixedExpenseModal" @close="close" max-width="md">
        <div class="p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar despesa fixa?</h3>

                <TransparentButton @click="toggleModal('confirmDeleteModal')">
                    <TrashIcon class="text-red-600 dark:text-red-600" />
                </TransparentButton>
            </div>

            <form @submit.prevent="edit" class="grid gap-4">
                <div>
                    <InputLabel for="type" value="Tipo" />
                    <TextInput id="type" v-model="form.type" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div>
                    <Select id="paymentType" v-model="form.paymentType" label="Forma de Pagamento" :options="paymentTypeMock.map((type, index) => ({ value: index, label: type }))" />
                    <InputError class="mt-2" :message="form.errors.paymentType" />
                </div>

                <div>
                    <InputLabel for="value" value="Valor" />
                    <TextInput id="value" v-model="form.value" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.value" />
                </div>

                <div class="flex items-center">
                    <InputLabel for="remember" value="Recorrente" class="me-2" />
                    <Checkbox id="remember" v-model:checked="form.recurrent" />
                    <InputError class="mt-2" :message="form.errors.recurrent" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <PrimaryButton class="mb-2 me-2 px-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Salvar </PrimaryButton>

                    <SecondaryButton @click="close"> Cancelar </SecondaryButton>
                </div>
            </form>
        </div>
    </Modal>

    <ConfirmDeleteModal :showConfimDeleteModal="modals.confirmDeleteModal" @close="toggleModal('confirmDeleteModal')" @confirm-delete="deleteItem" />
</template>
