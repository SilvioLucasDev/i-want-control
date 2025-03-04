<script setup lang="ts">
import { onMounted, onUnmounted, PropType, ref } from 'vue';

const props = defineProps({
    tabs: {
        type: Array as PropType<{ key: string; label: string }[]>,
        required: true,
    },
});

const emit = defineEmits<{
    (event: 'setActiveTab', value: string): void;
}>();

const activeTab = ref(props.tabs[0].key);
const tabsContainer = ref<HTMLElement | null>(null);
const isDragging = ref(false);
const startX = ref(0);
const scrollLeft = ref(0);

const setActiveTab = (tab: string): void => {
    activeTab.value = tab;
    emit('setActiveTab', tab);
};

const startDragging = (event: MouseEvent | TouchEvent) => {
    if (!tabsContainer.value) return;
    isDragging.value = true;

    const pageX = event instanceof MouseEvent ? event.pageX : event.touches[0].pageX;

    startX.value = pageX;
    scrollLeft.value = tabsContainer.value.scrollLeft;

    document.body.style.userSelect = 'none';
};

const stopDragging = () => {
    isDragging.value = false;
    document.body.style.userSelect = '';
};

const dragMove = (event: MouseEvent | TouchEvent) => {
    if (!isDragging.value || !tabsContainer.value) return;

    const pageX = event instanceof MouseEvent ? event.pageX : event.touches[0].pageX;

    const walk = (pageX - startX.value) * 1.5;
    tabsContainer.value.scrollLeft = scrollLeft.value - walk;
};

onMounted(() => {
    document.addEventListener('mouseup', stopDragging);
    document.addEventListener('mousemove', dragMove, { passive: false });

    document.addEventListener('touchend', stopDragging);
    document.addEventListener('touchmove', dragMove, { passive: false });
});

onUnmounted(() => {
    document.removeEventListener('mouseup', stopDragging);
    document.removeEventListener('mousemove', dragMove);

    document.removeEventListener('touchend', stopDragging);
    document.removeEventListener('touchmove', dragMove);

    setActiveTab(props.tabs[0].key);
});
</script>

<template>
    <ul
        ref="tabsContainer"
        class="mb-4 flex cursor-grab overflow-x-auto whitespace-nowrap border-b border-gray-200 text-sm font-medium text-gray-500 active:cursor-grabbing dark:border-gray-700 dark:text-gray-400"
        @mousedown="startDragging"
        @touchstart="startDragging"
    >
        <li v-for="tab in tabs" :key="tab.key" class="mr-2">
            <button
                @click="setActiveTab(tab.key)"
                class="border-b-2 px-4 py-2 transition duration-150 ease-in-out"
                :class="{
                    'border-blue-600 text-blue-600 dark:border-blue-500 dark:text-blue-500': tab.key === activeTab,
                    'border-transparent hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300': tab.key !== activeTab,
                }"
            >
                {{ tab.label }}
            </button>
        </li>
    </ul>
</template>

<style scoped>
.cursor-grab {
    cursor: grab;
}

.cursor-grabbing {
    cursor: grabbing;
}

::-webkit-scrollbar {
    display: none;
}
</style>
