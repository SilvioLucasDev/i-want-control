<script setup lang="ts">
import DangerButton from '@/Components/Buttons/DangerButton.vue';
import SecondaryButton from '@/Components/Buttons/SecondaryButton.vue';
import Modal from '@/Components/Modal/Modal.vue';
import { ref } from 'vue';

const showModal = ref<boolean>(false);
</script>

<template>
    <button @click="showModal = true" class="text-blue-500">Abrir modal</button>

    <Modal :show="showModal" @close="showModal = false" max-width="md">
        <div class="p-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Tem certeza que deseja deletar esse item?</h3>

            <div class="mt-4 grid grid-cols-2 gap-2">
                <DangerButton
                    @click="
                        () => {
                            setMonthYear();
                            selectDate();
                            showModal = false;
                        }
                    "
                >
                    Sim, eu tenho.
                </DangerButton>

                <SecondaryButton @click="showModal = false"> Cancelar </SecondaryButton>
            </div>
        </div>
    </Modal>
</template>
