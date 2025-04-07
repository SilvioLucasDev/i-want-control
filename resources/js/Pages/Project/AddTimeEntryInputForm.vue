<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import TimePickerInput from '@/Components/Inputs/TimePickerInput.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useForm } from '@inertiajs/vue3';

defineProps({
    showAddTimeEntryInputModal: Boolean,
});

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const form = useForm({
    scope: '',
    description: '',
    startTime: '',
    endTime: '',
});

const save = (): void => {
    console.log('DASHBOARD :: Save Time Entry Input', form);
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
                    <InputError class="mt-2" :message="form.errors.scope" />
                </div>

                <div>
                    <InputLabel for="description" value="Descrição" />
                    <TextInput id="description" v-model="form.description" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.description" />
                </div>

                <div>
                    <InputLabel for="startTime" value="Horário Inicial" />
                    <TimePickerInput id="startTime" v-model="form.startTime" />
                    <InputError class="mt-2" :message="form.errors.startTime" />
                </div>

                <div>
                    <InputLabel for="endTime" value="Horário Final" />
                    <TimePickerInput id="endTime" v-model="form.endTime" />
                    <InputError class="mt-2" :message="form.errors.endTime" />
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <PrimaryButton class="mb-2 me-2 px-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Salvar </PrimaryButton>

                    <SecondaryButton @click="close"> Cancelar </SecondaryButton>
                </div>
            </form>
        </div>
    </Modal>
</template>
