<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
    name: String,
    image: String,
});

const initials = computed(() => {
    if (!props.name) return 'U';

    const names = props.name.split(' ');
    return names.length > 1 ? `${names[0][0]}${names[1][0]}`.toUpperCase() : names[0][0].toUpperCase();
});
</script>

<template>
    <div class="flex items-center space-x-3">
        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-300 font-semibold text-gray-800" v-if="!image">
            {{ initials }}
        </div>
        <img v-else class="h-8 w-8 rounded-full" :src="image" alt="User avatar" />
    </div>
</template>
