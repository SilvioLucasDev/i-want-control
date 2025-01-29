<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';

defineProps<{
    mustVerifyEmail?: boolean;
    status?: string;
}>();
</script>

<template>
    <Head title="Profile" />

    <div class="space-y-6">
        <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
            <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status" />
        </div>

        <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
            <UpdatePasswordForm />
        </div>

        <div class="bg-white p-4 shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
            <DeleteUserForm />
        </div>
    </div>
</template>
