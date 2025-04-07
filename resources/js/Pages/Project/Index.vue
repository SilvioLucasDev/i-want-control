<script setup lang="ts">
import PlusButton from '@/Components/Buttons/PlusButton.vue';
import TransparentButton from '@/Components/Buttons/TransparentButton.vue';
import Calendar, { SelectDate } from '@/Components/Calendar.vue';
import DashboardCard from '@/Components/DashboardCard.vue';
import CashRegisterIcon from '@/Components/Icons/CashRegisterIcon.vue';
import DollarIcon from '@/Components/Icons/DollarIcon.vue';
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
import { useProjects } from '@/Composables/useProjects';

import { Head, router } from '@inertiajs/vue3';
import { nextTick, onMounted, ref } from 'vue';

const { isEditing } = useEditMode();
const { projects } = useProjects();

const props = defineProps({
    selected_month: {
        type: Number,
        required: true,
    },
    selected_year: {
        type: Number,
        required: true,
    },
    project_id: {
        type: Number,
        required: true,
    },
    monthly_project_control: {
        type: Object,
        required: true,
    },
    posting_project_activities: {
        type: Array,
        required: true,
    },
});

const selectedMonth = ref<number | null>(null);
const selectedYear = ref<number | null>(null);
const selectedProject = ref<number>(0);
const postingProjectActivities = ref<any[]>([]);

const hourlyRate = ref<number | null>(null);
const totalHoursWorked = ref<number | null>(null);
const totalReceivable = ref<number | null>(null);

const fetchData = ({ month, year }: SelectDate) => {
    selectedMonth.value = month ?? selectedMonth.value;
    selectedYear.value = year ?? selectedYear.value;

    router.get(
        route('projects.index'),
        {
            project_id: selectedProject.value,
            selected_month: selectedMonth.value,
            selected_year: selectedYear.value,
        },
        {
            preserveState: true,
            preserveScroll: true,
            onSuccess: () => {
                defineVariables();
            },
        },
    );
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

const defineVariables = () => {
    selectedMonth.value = props.selected_month;
    selectedYear.value = props.selected_year;
    selectedProject.value = props.project_id;
    postingProjectActivities.value = props.posting_project_activities;

    hourlyRate.value = props.monthly_project_control.hourly_rate;
    totalHoursWorked.value = props.monthly_project_control.total_hours_worked;
    totalReceivable.value = props.monthly_project_control.total_receivable;
};

onMounted(() => {
    defineVariables();
});
</script>

<template>
    <Head title="Projetos" />

    <Calendar @select-date="fetchData" />

    <div class="grid w-full gap-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
            <DashboardCard title="Valor Hora" :text="hourlyRate">
                <DollarIcon />
            </DashboardCard>

            <DashboardCard title="Horas Trabalhadas" :text="totalHoursWorked">
                <HourglassIcon />
            </DashboardCard>

            <DashboardCard title="Total" :text="totalReceivable">
                <CashRegisterIcon />
            </DashboardCard>
        </div>

        <Table>
            <template #header>
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <Select v-model="selectedProject" :options="projects.map((item) => ({ value: item.id, label: item.name }))" @change="fetchData" class="w-full sm:w-64" />
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
                <TrBody withBorder v-for="item in postingProjectActivities" :key="item.id">
                    <ThBody>{{ item.scope }}</ThBody>
                    <TdBody>{{ item.description }}</TdBody>
                    <TdBody>{{ item.initial_time }}</TdBody>
                    <TdBody>{{ item.final_time }}</TdBody>
                    <TdBody>{{ item.duration }}</TdBody>

                    <TdBody v-if="isEditing" class="px-0">
                        <TransparentButton @click="editItem('editTimeEntryInput', item)">
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
