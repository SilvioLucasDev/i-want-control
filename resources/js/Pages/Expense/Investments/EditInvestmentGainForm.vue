<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import TrashIcon from '@/Components/Icons/TrashIcon.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import Select from '@/Components/Inputs/Select.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import ConfirmDeleteModal from '@/Components/Modal/ConfirmDeleteModal.vue';
import Modal from '@/Components/Modal/Modal.vue';

import { useForm } from '@inertiajs/vue3';
import { PropType, ref, watch } from 'vue';

const props = defineProps({
    showEditInvestmentGainModal: Boolean,
    item: Object as PropType<{ id: number; type: string; income: string; value: string } | null>,
});

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const form = useForm({
    id: props.item?.id ?? 0,
    type: props.item?.type ?? '',
    income: props.item?.income ?? '',
    value: props.item?.value ?? '',
});

watch(
    () => props.item,
    (newItem) => {
        if (newItem) {
            form.id = newItem.id ?? 0;
            form.type = newItem.type ?? '';
            form.income = newItem.income ?? '';
            form.value = newItem.value ?? '';
        }
    },
    { deep: true, immediate: true },
);

const edit = (): void => {
    console.log('DASHBOARD :: Edit Investment Gain', form);
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

const projectTypeMock = ref<string[]>(['FII', 'Criptomoeda', 'Renda Fixa', 'Tesouro']);
</script>

<template>
    <Modal :show="showEditInvestmentGainModal" @close="close" max-width="md">
        <div class="p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Editar ganho de investimento?</h3>

                <TransparentButton @click="toggleModal('confirmDeleteModal')">
                    <TrashIcon class="text-red-600 dark:text-red-600" />
                </TransparentButton>
            </div>

            <form @submit.prevent="edit" class="grid gap-4">
                <div>
                    <Select id="type" v-model="form.type" label="Tipo" :options="projectTypeMock.map((type, index) => ({ value: index, label: type }))" />
                    <InputError class="mt-2" :message="form.errors.type" />
                </div>

                <div>
                    <InputLabel for="income" value="Rentabilidade" />
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 text-gray-900 dark:text-gray-400">%</div>
                        <TextInput id="income" v-model="form.income" type="text" class="block w-full p-2.5 pe-10" />
                    </div>
                    <InputError class="mt-2" :message="form.errors.income" />
                </div>

                <div>
                    <InputLabel for="value" value="Valor" />
                    <TextInput id="value" v-model="form.value" type="text" class="mt-1 block w-full" />
                    <InputError class="mt-2" :message="form.errors.value" />
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
