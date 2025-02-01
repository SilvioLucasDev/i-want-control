<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => ['px-6 py-3', props.class]);
</script>

<template>
    <td v-bind="$attrs" :class="classes">
        <slot />
    </td>
</template>
