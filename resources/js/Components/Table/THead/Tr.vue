<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => ['font-semibold text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-700', props.class]);
</script>

<template>
    <tr v-bind="$attrs" :class="classes">
        <slot />
    </tr>
</template>
