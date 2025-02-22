<script setup lang="ts">
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Avatar from '@/Components/Avatar.vue';
import BarsIcon from '@/Components/Icons/BarsIcon.vue';
import DashboardIcon from '@/Components/Icons/DashboardIcon.vue';
import LogoutIcon from '@/Components/Icons/LogoutIcon.vue';
import MoonIcon from '@/Components/Icons/MoonIcon.vue';
import SunIcon from '@/Components/Icons/SunIcon.vue';
import NavLink from '@/Components/Navigation/NavLink.vue';
import SideDropdown from '@/Components/Navigation/SideDropdown.vue';
import { applyDarkMode } from '@/dark-mode';
import { Link } from '@inertiajs/vue3';

import { computed, onMounted, onUnmounted, ref } from 'vue';

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

onMounted(() => {
    updateIsMobile();
    window.addEventListener('resize', updateIsMobile);

    applyDarkMode();
});

onUnmounted(() => {
    window.removeEventListener('resize', updateIsMobile);
});
</script>

<template>
    <div>
        <div class="flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar Mobile -->
            <aside v-show="isMobile" :class="[isSidebarOpen ? 'h-screen w-64 bg-gray-50 dark:bg-gray-800' : 'w-screen bg-gray-100 dark:bg-gray-900', 'fixed left-0 top-0 z-40']" aria-label="Mobile Sidebar">
                <div :class="[isSidebarOpen ? 'bg-gray-50 px-3 py-4 dark:bg-gray-800' : 'bg-gray-100 dark:bg-gray-900', 'flex h-full flex-col overflow-y-auto']">
                    <div :class="[isSidebarOpen ? 'mb-5' : '', 'flex items-center justify-between']">
                        <Link v-show="isSidebarOpen" :href="route('dashboard')" class="flex items-center ps-2.5">
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
                            <BarsIcon />
                        </button>
                    </div>

                    <ul v-show="isSidebarOpen" class="space-y-2 font-medium">
                        <li>
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <DashboardIcon />
                                <span class="ms-3">Dashboard</span>
                            </NavLink>
                        </li>

                        <SideDropdown
                            title="Controles"
                            :links="[
                                { label: 'Gastos', routeName: 'expenses' },
                                { label: 'Serviços', routeName: 'services' },
                            ]"
                        />
                    </ul>

                    <ul v-show="isSidebarOpen" class="mt-auto space-y-2 border-t border-gray-200 pt-4 font-medium dark:border-gray-700">
                        <li>
                            <div class="group flex justify-between rounded-lg p-2 text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <div class="flex items-center">
                                    <MoonIcon id="theme-toggle-dark-icon-mobile" class="hidden" />
                                    <SunIcon id="theme-toggle-light-icon-mobile" class="hidden" />
                                    <span id="theme-toggle-text-mobile" class="ms-3">Dark Mode</span>
                                </div>

                                <label class="inline-flex cursor-pointer items-center">
                                    <input id="theme-toggle-checkbox-mobile" type="checkbox" value="" class="peer sr-only" />
                                    <div
                                        class="peer relative h-5 w-9 rounded-full bg-gray-900 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-900 after:bg-white after:transition-all after:content-[''] peer-checked:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-checked:bg-gray-600 dark:peer-focus:ring-gray-800 rtl:peer-checked:after:-translate-x-full"
                                    ></div>
                                </label>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center justify-between p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <NavLink :href="route('profile.edit')" class="group flex items-center rounded-lg">
                                    <img class="h-8 w-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo" />
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
                        <Link v-show="isSidebarOpen" :href="route('dashboard')" class="flex items-center ps-2.5">
                            <ApplicationLogo class="block h-9 w-auto fill-current pe-2 text-gray-800 dark:text-gray-200" />
                            <span class="self-center whitespace-nowrap text-xl font-semibold dark:text-white">IWC</span>
                        </Link>

                        <button
                            @click="toggleSidebar"
                            type="button"
                            class="inline-flex items-center rounded-lg p-2 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        >
                            <BarsIcon />
                        </button>
                    </div>

                    <ul v-show="isSidebarOpen" class="space-y-2 font-medium">
                        <li>
                            <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="group flex items-center rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <DashboardIcon :active="route().current('dashboard')" />
                                <span class="ms-3">Dashboard</span>
                            </NavLink>
                        </li>

                        <SideDropdown
                            title="Controles"
                            :links="[
                                { label: 'Gastos', routeName: 'expenses' },
                                { label: 'Serviços', routeName: 'services' },
                            ]"
                        />
                    </ul>

                    <ul v-show="isSidebarOpen" class="mt-auto space-y-2 border-t border-gray-200 pt-4 font-medium dark:border-gray-700">
                        <li>
                            <div class="group flex justify-between rounded-lg bg-gray-100 p-2 text-gray-900 transition duration-75 dark:bg-gray-700 dark:text-white">
                                <div class="flex items-center">
                                    <MoonIcon id="theme-toggle-dark-icon" class="hidden" />
                                    <SunIcon id="theme-toggle-light-icon" class="hidden" />
                                    <span id="theme-toggle-text" class="ms-3">Dark Mode</span>
                                </div>

                                <label class="inline-flex cursor-pointer items-center">
                                    <input id="theme-toggle-checkbox" type="checkbox" value="" class="peer sr-only" />
                                    <div
                                        class="peer relative h-5 w-9 rounded-full bg-gray-900 after:absolute after:start-[2px] after:top-[2px] after:h-4 after:w-4 after:rounded-full after:border after:border-gray-900 after:bg-white after:transition-all after:content-[''] peer-checked:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-gray-300 dark:peer-checked:bg-gray-600 dark:peer-focus:ring-gray-800 rtl:peer-checked:after:-translate-x-full"
                                    ></div>
                                </label>
                            </div>
                        </li>

                        <li>
                            <div class="flex items-center justify-between rounded-lg p-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                <NavLink :href="route('profile.edit')" class="group flex items-center">
                                    <Avatar :name="props.auth.user.name" :image="props.auth.user.profile_picture" />
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

            <main :class="[isMobile ? (isSidebarOpen ? 'w-0' : 'w-full') : isSidebarOpen ? 'ml-64' : 'ml-16', 'flex-1 pt-12 transition-all']">
                <div class="max-w-8xl mx-auto flex flex-col items-center justify-center gap-y-10 md:px-6 lg:px-8">
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
