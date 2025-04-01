<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Avatar from '@/Components/Avatar.vue';
import BarsFromLeftIcon from '@/Components/Icons/BarsFromLeftIcon.vue';
import BarsIcon from '@/Components/Icons/BarsIcon.vue';
import DashboardIcon from '@/Components/Icons/DashboardIcon.vue';
import LogoutIcon from '@/Components/Icons/LogoutIcon.vue';
import MoonIcon from '@/Components/Icons/MoonIcon.vue';
import SunIcon from '@/Components/Icons/SunIcon.vue';
import ToggleInput from '@/Components/Inputs/ToggleInput.vue';
import NavLink from '@/Components/Navigation/NavLink.vue';
import SideDropdown from '@/Components/Navigation/SideDropdown.vue';
import Toast from '@/Components/Toast.vue';

import Settings from '@/Pages/Settings/Index.vue';

import { useDarkMode } from '@/Composables/useDarkMode';
import { provideEditMode } from '@/Composables/useEditMode';
import { provideInvestments } from '@/Composables/useInvestments';
import { providePaymentMethods } from '@/Composables/usePaymentMethods';
import { provideProjects } from '@/Composables/useProjects';

import { Link } from '@inertiajs/vue3';
import { computed, onMounted, onUnmounted, ref } from 'vue';

const { isDarkMode, toggleDarkMode, themeText } = useDarkMode();

provideEditMode();
providePaymentMethods();
provideInvestments();
provideProjects();

const props = defineProps<{
    auth: {
        user: {
            name: string;
        };
    };
}>();

const isSidebarOpen = ref(true);

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
};

const isMobile = ref(false);

const updateIsMobile = () => {
    isMobile.value = window.innerWidth <= 767;
};

const getFirstName = (fullName: string): string => {
    return fullName.split(' ')[0];
};

const firstName = computed(() => getFirstName(props.auth.user.name));

const modals = ref({
    settings: false,
});

const toggleModal = (type: 'settings') => {
    modals.value[type] = !modals.value[type];
};

onMounted(() => {
    updateIsMobile();
    window.addEventListener('resize', updateIsMobile);
});

onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile);
});
</script>

<template>
    <div>
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="fixed right-0 top-0 z-50 inline-flex items-center">
                <button
                    @click="toggleModal('settings')"
                    type="button"
                    class="mx-1 my-1 inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                >
                    <BarsIcon />
                </button>
            </div>

            <!-- Sidebar Mobile -->
            <aside v-show="isMobile" :class="[isSidebarOpen ? 'h-screen w-64 bg-gray-50 dark:bg-gray-800' : 'w-screen bg-gray-100 dark:bg-gray-900', 'fixed left-0 top-0 z-40']" aria-label="Mobile Sidebar">
                <div :class="[isSidebarOpen ? 'bg-gray-50 px-3 py-4 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-900', 'flex h-full flex-col overflow-y-auto']">
                    <div :class="[isSidebarOpen ? 'mb-5' : '', 'flex items-center justify-between']">
                        <Link v-show="isSidebarOpen" :href="route('dashboard.index')" class="flex items-center ps-2.5">
                            <ApplicationLogo class="block h-9 w-auto fill-current pe-2 text-gray-800 dark:text-gray-200" />
                            <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">IWC</span>
                        </Link>

                        <button
                            @click="toggleSidebar"
                            type="button"
                            :class="[
                                isSidebarOpen ? '' : 'mx-1 my-1',
                                'inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600',
                            ]"
                        >
                            <BarsFromLeftIcon />
                        </button>
                    </div>

                    <ul v-show="isSidebarOpen" class="space-y-2 font-medium">
                        <li>
                            <NavLink :href="route('dashboard.index')" :active="route().current('dashboard.index')" class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <DashboardIcon />
                                <span class="ms-3">Dashboard</span>
                            </NavLink>
                        </li>

                        <SideDropdown
                            title="Controles"
                            :links="[
                                { label: 'Gastos', routeName: 'expenses.index' },
                                { label: 'Projetos', routeName: 'projects.index' },
                            ]"
                        />
                    </ul>

                    <ul v-show="isSidebarOpen" class="mt-auto space-y-2 border-t border-gray-200 pt-4 font-medium dark:border-gray-700">
                        <li>
                            <div class="group flex justify-between rounded-lg bg-gray-100 p-2 text-gray-900 transition duration-75 dark:bg-gray-700 dark:text-white">
                                <div class="flex items-center">
                                    <MoonIcon v-if="!isDarkMode" class="hidden" />
                                    <SunIcon v-else class="hidden" />
                                    <span class="ms-3">{{ themeText }}</span>
                                </div>

                                <ToggleInput :checked="isDarkMode" @toggle="toggleDarkMode" />
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center justify-between p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <NavLink :href="route('profile.edit')" class="group flex items-center">
                                    <Avatar :name="props.auth.user.name" />
                                    <span class="ms-3 flex-1 whitespace-nowrap">{{ firstName }}</span>
                                </NavLink>
                                <NavLink :href="route('logout')" method="post" as="button">
                                    <LogoutIcon />
                                </NavLink>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Sidebar Desktop -->
            <aside v-show="!isMobile" :class="[isSidebarOpen ? 'w-64' : 'w-16', 'fixed left-0 top-0 z-40 h-screen bg-gray-50 transition-all dark:bg-gray-800']" aria-label="Desktop Sidebar">
                <div class="flex h-full flex-col overflow-y-auto bg-gray-50 px-3 py-4 dark:bg-gray-800">
                    <div class="mb-5 flex items-center justify-between">
                        <Link v-show="isSidebarOpen" :href="route('dashboard.index')" class="flex items-center ps-2.5">
                            <ApplicationLogo class="block h-9 w-auto fill-current pe-2 text-gray-800 dark:text-gray-200" />
                            <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">IWC</span>
                        </Link>

                        <button
                            @click="toggleSidebar"
                            type="button"
                            class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        >
                            <BarsFromLeftIcon />
                        </button>
                    </div>

                    <ul v-show="isSidebarOpen" class="space-y-2 font-medium">
                        <li>
                            <NavLink :href="route('dashboard.index')" :active="route().current('dashboard.index')" class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <DashboardIcon :active="route().current('dashboard.index')" />
                                <span class="ms-3">Dashboard</span>
                            </NavLink>
                        </li>

                        <SideDropdown
                            title="Controles"
                            :links="[
                                { label: 'Gastos', routeName: 'expenses.index' },
                                { label: 'Projetos', routeName: 'projects.index' },
                            ]"
                        />
                    </ul>

                    <ul v-show="isSidebarOpen" class="mt-auto space-y-2 border-t border-gray-200 pt-4 font-medium dark:border-gray-700">
                        <li>
                            <div class="group flex justify-between rounded-lg bg-gray-100 p-2 text-gray-900 transition duration-75 dark:bg-gray-700 dark:text-white">
                                <div class="flex items-center">
                                    <MoonIcon v-if="!isDarkMode" class="hidden" />
                                    <SunIcon v-else class="hidden" />
                                    <span class="ms-3">{{ themeText }}</span>
                                </div>

                                <ToggleInput :checked="isDarkMode" @toggle="toggleDarkMode" />
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center justify-between rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <NavLink :href="route('profile.edit')" class="group flex items-center">
                                    <Avatar :name="props.auth.user.name" />
                                    <span class="ms-3 flex-1 whitespace-nowrap">{{ firstName }}</span>
                                </NavLink>
                                <NavLink :href="route('logout')" method="post" as="button">
                                    <LogoutIcon />
                                </NavLink>
                            </div>
                        </li>
                    </ul>
                </div>
            </aside>

            <main :class="[isMobile ? (isSidebarOpen ? 'w-0' : 'w-full') : isSidebarOpen ? 'ml-64' : 'ml-16', 'flex-1 py-12 transition-all']">
                <div class="max-w-8xl mx-auto flex flex-col items-center justify-center gap-y-10 md:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>

    <Settings :showSettingsModal="modals.settings" @close="toggleModal('settings')" />

    <Toast />
</template>
