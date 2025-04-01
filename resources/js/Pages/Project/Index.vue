<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import DashboardCard from '@/Components/DashboardCard.vue';
import CashRegisterIcon from '@/Components/Icons/CashRegisterIcon.vue';
import DolarIcon from '@/Components/Icons/DolarIcon.vue';
import DotsIcon from '@/Components/Icons/DotsIcon.vue';
import HourglassIcon from '@/Components/Icons/HourglassIcon.vue';
import Select from '@/Components/Inputs/Select.vue';
import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import TdFoot from '@/Components/Table/TFoot/Td.vue';
import ThFoot from '@/Components/Table/TFoot/Th.vue';
import ThHead from '@/Components/Table/THead/Th.vue';

import AddTimeEntryInputForm from '@/Pages/Project/AddTimeEntryInputForm.vue';
import EditTimeEntryInputForm from '@/Pages/Project/EditTimeEntryInputForm.vue';

import { useEditMode } from '@/Composables/useEditMode';

import { Head } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const { isEditing } = useEditMode();

const monthSelected = ref<number | null>(null);
const yearSelected = ref<number | null>(null);
const projectSelected = ref<string>('1');

const fetchData = ({ month, year }: SelectDate) => {
    monthSelected.value = month;
    yearSelected.value = year;

    console.log(`PROJECTS :: Fetching data for: ${month} / ${year} and project: ${projectSelected.value}`);
};

type AddModalType = 'addTimeEntryInput';

type EditModalType = 'editTimeEntryInput';

type ModalType = AddModalType | EditModalType;

const modals = ref<Record<ModalType, boolean>>({
    addTimeEntryInput: false,
    editTimeEntryInput: false,
});

const toggleModal = (type: ModalType) => {
    modals.value[type] = !modals.value[type];
};

type Item = { id: number; scope: string; description: string; initialTime: string; endTime: string };

const itemToEdit = ref<Item | null>(null);

const editItem = async (type: EditModalType, item: Item) => {
    itemToEdit.value = { ...item };
    await nextTick();
    toggleModal(type);
};

const projectsMock = ref<string[]>(['Wakami', 'Gestione', 'MFA', 'IWantControl', 'ABBA']);
</script>

<template>
    <Head title="Projetos" />

    <Calendar @select-date="fetchData" />

    <div class="grid w-full gap-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
            <DashboardCard title="Valor Hora" text="R$ 100,00">
                <DolarIcon />
            </DashboardCard>

            <DashboardCard title="Horas Trabalhadas" text="12H">
                <HourglassIcon />
            </DashboardCard>

            <DashboardCard title="Total" text="R$ 1.200,00">
                <CashRegisterIcon />
            </DashboardCard>
        </div>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <Select v-model="projectSelected" :options="projectsMock.map((type, index) => ({ value: index, label: type }))" @change="fetchData" class="w-full sm:w-64" />
                    </div>

                    <div>
                        <PlusButton @click="toggleModal('addTimeEntryInput')" />
                    </div>
                </div>
            </template>

            <template #thead>
                <ThHead class="text-start">Escopo</ThHead>
                <ThHead>Descrição</ThHead>
                <ThHead>Início</ThHead>
                <ThHead>Fim</ThHead>
                <ThHead>Duração</ThHead>
                <ThHead v-if="isEditing" class="px-0"></ThHead>
            </template>

            <template #tbody>
                <TrBody withBorder>
                    <ThBody>ADM</ThBody>
                    <TdBody>Finalizei o fluxo de autenticação utilizando OAUTH2</TdBody>
                    <TdBody>08:00</TdBody>
                    <TdBody>12:00</TdBody>
                    <TdBody>4h</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editTimeEntryInput', { id: 1, scope: 'ADM', description: 'Finalizei o fluxo de autenticação utilizando OAUTH2', initialTime: '08:00', endTime: '12:00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Site</ThBody>
                    <TdBody>Iniciei os ajustes na landing page</TdBody>
                    <TdBody>13:00</TdBody>
                    <TdBody>18:00</TdBody>
                    <TdBody>5h</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editTimeEntryInput', { id: 2, scope: 'Site', description: 'Iniciei os ajustes na landing page', initialTime: '13:00', endTime: '18:00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>

                <TrBody withBorder>
                    <ThBody>Infra</ThBody>
                    <TdBody>Configurei o servidor EC2 na AWS</TdBody>
                    <TdBody>19:00</TdBody>
                    <TdBody>22:00</TdBody>
                    <TdBody>3h</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editTimeEntryInput', { id: 3, scope: 'Infra', description: 'Configurei o servidor EC2 na AWS', initialTime: '19:00', endTime: '22:00' })">
                            <DotsIcon />
                        </TransparentButton>
                    </TdBody>
                </TrBody>
            </template>

            <template #tfoot>
                <ThFoot></ThFoot>
                <TdFoot></TdFoot>
                <TdFoot></TdFoot>
                <TdFoot></TdFoot>
                <TdFoot></TdFoot>
                <TdFoot v-if="isEditing" class="px-0"></TdFoot>
            </template>
        </Table>
    </div>

    <AddTimeEntryInputForm :showAddTimeEntryInputModal="modals.addTimeEntryInput" @close="toggleModal('addTimeEntryInput')" />
    <EditTimeEntryInputForm :showEditTimeEntryInputModal="modals.editTimeEntryInput" @close="toggleModal('editTimeEntryInput')" :item="itemToEdit" />
</template>
