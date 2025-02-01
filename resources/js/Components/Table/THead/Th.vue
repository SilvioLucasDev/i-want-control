<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    class: String,
    screenReaderOnly: Boolean,
});

const classes = computed(() => ['px-6 py-3', props.class]);
</script>

<template>
    <th scope="col" v-bind="$attrs" :class="classes">
        <span v-if="props.screenReaderOnly" class="sr-only">
            <slot />
        </span>
        <slot v-else />
    </th>
</template>
