<script setup lang="ts">
import Modal from '@/Components/Modal/Modal.vue';
import TabsWithIcons from '@/Components/Navigation/TabsWithIcons.vue';
import { provideInvestment } from '@/Composables/useInvestment';
import { providePaymentMethod } from '@/Composables/usePaymentMethod';
import { provideProjectMethod } from '@/Composables/useProject';

import Configuration from '@/Pages/Settings/Configuration.vue';
import Export from '@/Pages/Settings/Export.vue';
import Investments from '@/Pages/Settings/Investments.vue';
import PaymentMethods from '@/Pages/Settings/PaymentMethods.vue';
import Projects from '@/Pages/Settings/Projects.vue';

import { ref } from 'vue';

providePaymentMethod();
provideInvestment();
provideProjectMethod();

defineProps<{ showSettingsModal: boolean }>();

const emit = defineEmits(['close']);

const close = (): void => {
    emit('close');
};

const activeTab = ref<string>('paymentMethods');

const setActiveTab = (tab: string): void => {
    activeTab.value = tab;
};
</script>

<template>
    <Modal :show="showSettingsModal" @close="close" max-width="2xl">
        <div class="p-6">
            <TabsWithIcons
                :tabs="[
                    { key: 'paymentMethods', label: 'Métodos de Pagamento' },
                    { key: 'investments', label: 'Investimentos' },
                    { key: 'projects', label: 'Projetos' },
                    { key: 'export', label: 'Exportação' },
                    { key: 'configuration', label: 'Configurações' },
                ]"
                @set-active-tab="setActiveTab"
            />

            <template v-if="activeTab === 'paymentMethods'">
                <PaymentMethods />
            </template>

            <template v-if="activeTab === 'investments'">
                <Investments />
            </template>

            <template v-if="activeTab === 'projects'">
                <Projects />
            </template>

            <template v-if="activeTab === 'export'">
                <Export />
            </template>

            <template v-if="activeTab === 'configuration'">
                <Configuration />
            </template>
        </div>
    </Modal>
</template>
