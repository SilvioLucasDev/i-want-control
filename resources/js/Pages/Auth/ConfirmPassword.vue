<script setup lang="ts">
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import InputError from '@/Components/Inputs/InputError.vue';
import InputLabel from '@/Components/Inputs/InputLabel.vue';
import TextInput from '@/Components/Inputs/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineOptions({ layout: GuestLayout });

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <Head title="Confirm Password" />

    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">This is a secure area of the application. Please confirm your password before continuing.</div>

    <form @submit.prevent="submit">
        <div>
            <InputLabel for="password" value="Password" />
            <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" autofocus />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4 flex justify-end">
            <PrimaryButton class="mb-2 me-2 ms-4 px-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Confirm </PrimaryButton>
        </div>
    </form>
</template>
