<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() => (props.active ? 'dark:bg-gray-600 dark:text-white bg-gray-200 text-gray-900' : ''));
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
