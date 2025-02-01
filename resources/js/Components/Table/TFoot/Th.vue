<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
});

const classes = computed(() => ['px-6 py-3 text-base', props.class]);
</script>

<template>
    <th scope="row" v-bind="$attrs" :class="classes">
        <slot />
    </th>
</template>
