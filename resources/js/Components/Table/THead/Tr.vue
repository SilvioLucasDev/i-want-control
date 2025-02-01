<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => [props.class]);
</script>

<template>
    <tr v-bind="$attrs" :class="classes">
        <slot />
    </tr>
</template>
