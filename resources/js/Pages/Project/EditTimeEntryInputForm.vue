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

import { useFormFetch } from '@/Composables/useFormFetch';
import { useToast } from '@/Composables/useToast';

import { PropType, ref, watch } from 'vue';

const { triggerToast } = useToast();

const props = defineProps({
    showEditTimeEntryInputModal: Boolean,
    item: Object as PropType<{ id: number; scope: string; description: string; start_time: string; end_time: string } | null>,
});

const emit = defineEmits(['close', 'refresh']);

const close = (): void => {
    reset();
    emit('close');
};

const refresh = (): void => {
    emit('refresh');
};

const { form, errors, processing, reset, submit } = useFormFetch<{
    id: number;
    scope: string;
    description: string;
    start_time: string;
    end_time: string;
}>({
    id: props.item?.id ?? 0,
    scope: props.item?.scope ?? '',
    description: props.item?.description ?? '',
    start_time: props.item?.start_time ?? '',
    end_time: props.item?.end_time ?? '',
});

watch(
    () => props.item,
    (newItem) => {
        if (newItem) {
            form.id = newItem.id ?? 0;
            form.scope = newItem.scope ?? '';
            form.description = newItem.description ?? '';
            form.start_time = newItem.start_time ?? '';
            form.end_time = newItem.end_time ?? '';
        }
    },
    { deep: true, immediate: true },
);

const edit = async (): Promise<void> => {
    const { ok, type, error } = await submit('put', route('posting-project-activities.update', form.id));

    if (ok) {
        triggerToast('success', 'Entrada de horário editada com sucesso!');
        close();
        refresh();
    } else if (type === 'generic') {
        triggerToast('error', error || 'Erro ao editar entrada de horário!');
    }
};

const modals = ref({
    confirmDeleteModal: false,
});

const toggleModal = (type: 'confirmDeleteModal') => {
    modals.value[type] = !modals.value[type];
};

const deleteItem = async (): Promise<void> => {
    toggleModal('confirmDeleteModal');

    const { ok, type, error } = await submit('delete', route('posting-project-activities.destroy', form.id));
    if (ok) {
        triggerToast('success', 'Entrada de horário excluída com sucesso!');
        close();
        refresh();
    } else if (type === 'generic') {
        triggerToast('error', error || 'Erro ao excluir entrada de horário!');
    }
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
                    <InputError class="mt-2" :message="errors.scope" />
                </div>

                <div>
                    <InputLabel for="description" value="Descrição" />
                    <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="errors.description" />
                </div>

                <div>
                    <InputLabel for="startTime" value="Horário Inicial" />
                    <TimePickerInput id="startTime" v-model="form.start_time" />
                    <InputError class="mt-2" :message="errors.start_time" />
                </div>

                <div>
                    <InputLabel for="endTime" value="Horário Final" />
                    <TimePickerInput id="endTime" v-model="form.end_time" />
                    <InputError class="mt-2" :message="errors.end_time" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <PrimaryButton class="mb-2 me-2 px-5" :class="{ 'opacity-25': processing }" :disabled="processing"> Salvar </PrimaryButton>

                    <SecondaryButton @click="close"> Cancelar </SecondaryButton>
                </div>
            </form>
        </div>
    </Modal>

    <ConfirmDeleteModal :showConfimDeleteModal="modals.confirmDeleteModal" @close="toggleModal('confirmDeleteModal')" @confirm-delete="deleteItem" />
</template>
