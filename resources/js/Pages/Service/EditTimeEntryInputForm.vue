<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import TimePickerInput from '@/Components/Inputs/TimePickerInput.vue';
import ConfirmDeleteModal from '@/Components/Modal/ConfirmDeleteModal.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useForm } from '@inertiajs/vue3';
import { PropType, ref, watch } from 'vue';

const props = defineProps({
    showEditTimeEntryInputModal: Boolean,
    item: Object as PropType<{ id: number; scope: string; description: string; start: string; end: string } | null>,
});

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const form = useForm({
    id: props.item?.id ?? 0,
    scope: props.item?.scope ?? '',
    description: props.item?.description ?? '',
    start: props.item?.start ?? '',
    end: props.item?.end ?? '',
});

watch(
    () => props.item,
    (newItem) => {
        if (newItem) {
            form.id = newItem.id ?? 0;
            form.scope = newItem.scope ?? '';
            form.description = newItem.description ?? '';
            form.start = newItem.start ?? '';
            form.end = newItem.end ?? '';
        }
    },
    { deep: true, immediate: true },
);

const edit = (): void => {
    console.log('DASHBOARD :: Edit Time Entry Input', form);
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
</script>

<template>
    <Modal :show="showEditTimeEntryInputModal" @close="close" max-width="md">
        <div class="p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar entrada de horário?</h3>

                <TransparentButton @click="toggleModal('confirmDeleteModal')">
                    <TrashIcon class="text-red-600 dark:text-red-600" />
                </TransparentButton>
            </div>

            <form @submit.prevent="edit" class="grid gap-4">
                <div>
                    <InputLabel for="scope" value="Escopo" />
                    <TextInput id="scope" v-model="form.scope" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.scope" />
                </div>

                <div>
                    <InputLabel for="description" value="Descrição" />
                    <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <div>
                    <InputLabel for="start" value="Início" />
                    <TimePickerInput id="start" v-model="form.start" />
                    <InputError class="mt-2" :message="form.errors.start" />
                </div>

                <div>
                    <InputLabel for="time" value="Select time" />
                    <TimePickerInput id="end" v-model="form.end" />
                    <InputError class="mt-2" :message="form.errors.end" />
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
