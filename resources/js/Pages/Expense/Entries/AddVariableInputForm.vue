<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import Checkbox from '@/Components/Inputs/Checkbox.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useForm } from '@inertiajs/vue3';

defineProps({
    showAddVariableInputModal: Boolean,
});

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const form = useForm({
    type: '',
    value: '',
    recurrent: false,
});

const save = (): void => {
    console.log('DASHBOARD :: Save Variable Input', form);
};
</script>

<template>
    <Modal :show="showAddVariableInputModal" @close="close" max-width="md">
        <div class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Adicionar nova entrada variável?</h3>

            <form @submit.prevent="save" class="grid gap-4">
                <div>
                    <InputLabel for="type" value="Tipo" />
                    <TextInput id="type" v-model="form.type" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.type" />
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
</template>
