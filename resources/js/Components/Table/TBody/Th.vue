<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => ['whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white', props.class]);
</script>

<template>
    <th scope="row" v-bind="$attrs" :class="classes">
        <slot />
    </th>
</template>
