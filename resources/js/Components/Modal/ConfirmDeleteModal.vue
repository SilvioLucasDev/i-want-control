<script setup lang="ts">
import DangerButton from '@/Components/Buttons/DangerButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import Modal from '@/Components/Modal/Modal.vue';

defineProps({
    showConfimDeleteModal: Boolean,
});

const emit = defineEmits(['close', 'confirmDelete']);

const close = (): void => {
    emit('close');
};

const confirmDelete = (): void => {
    emit('confirmDelete');
};
</script>

<template>
    <Modal :show="showConfimDeleteModal" @close="close" max-width="md">
        <div class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Tem certeza que deseja deletar esse item?</h3>

            <div class="mt-4 grid grid-cols-2 gap-2">
                <DangerButton @click="confirmDelete"> Sim, eu tenho. </DangerButton>

                <SecondaryButton @click="close"> Cancelar </SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
