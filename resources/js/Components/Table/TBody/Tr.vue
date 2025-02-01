<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
    withBorder: Boolean,
});

const classes = computed(() => ['bg-white dark:bg-gray-800', props.withBorder ? 'border-b border-gray-200 dark:border-gray-700' : '', props.class]);
</script>

<template>
    <tr v-bind="$attrs" :class="classes">
        <slot />
    </tr>
</template>
