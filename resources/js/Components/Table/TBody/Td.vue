<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => ['px-6 py-4 text-center', props.class]);
</script>

<template>
    <td v-bind="$attrs" :class="classes">
        <slot />
    </td>
</template>
