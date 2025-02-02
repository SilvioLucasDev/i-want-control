<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: Boolean,
});

const classes = computed(() => (props.active ? 'dark:bg-gray-700 dark:text-white bg-gray-100 text-gray-900' : ''));
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
