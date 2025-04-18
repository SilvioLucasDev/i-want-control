<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import TimePickerInput from '@/Components/Inputs/TimePickerInput.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useFormFetch } from '@/Composables/useFormFetch';
import { useToast } from '@/Composables/useToast';

const { triggerToast } = useToast();

const props = defineProps({
    projectId: {
        type: Number,
        required: true,
    },
    monthlyProjectControlId: {
        type: [Number, null],
        required: true,
    },
    showAddTimeEntryInputModal: Boolean,
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
    project_id: number | null;
    monthly_project_control_id: number | null;
    scope: string;
    description: string;
    start_time: string;
    end_time: string;
}>({
    project_id: null,
    monthly_project_control_id: null,
    scope: '',
    description: '',
    start_time: '',
    end_time: '',
});

const save = async (): Promise<void> => {
    form.project_id = props.projectId;
    form.monthly_project_control_id = props.monthlyProjectControlId;

    const { ok, type, error } = await submit('post', route('posting-project-activities.store'));

    if (ok) {
        triggerToast('success', 'Entrada de horário adicionada com sucesso!');
        close();
        refresh();
    } else if (type === 'generic') {
        triggerToast('error', error || 'Erro ao adicionar entrada de horário!');
    }
};
</script>

<template>
    <Modal :show="showAddTimeEntryInputModal" @close="close" max-width="md">
        <div class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Adicionar nova entrada de horário?</h3>

            <form @submit.prevent="save" class="grid gap-4">
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
</template>
