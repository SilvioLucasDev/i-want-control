<script setup lang="ts">
import { useToast } from '@/Composables/useToast';

const { toasts } = useToast();

const toastClasses = (type: string) => {
    return {
        success: 'text-green-500 bg-green-100 dark:bg-green-800 dark:text-green-200',
        error: 'text-red-500 bg-red-100 dark:bg-red-800 dark:text-red-200',
        warning: 'text-orange-500 bg-orange-100 dark:bg-orange-700 dark:text-orange-200',
    }[type];
};

const iconPath = (type: string) => {
    return {
        success: 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z',
        error: 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z',
        warning: 'M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z',
    }[type];
};
</script>

<template>
    <Teleport to="body">
        <div class="fixed right-5 top-5 z-50 flex flex-col gap-3">
            <TransitionGroup
                enter-active-class="transform transition ease-out duration-300"
                enter-from-class="opacity-0 translate-y-2"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transform transition ease-in duration-200"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 translate-y-2"
            >
                <div v-for="toast in toasts" :key="toast.id" class="flex min-w-[350px] max-w-xs items-center rounded-lg bg-white p-4 text-gray-500 shadow-lg backdrop-blur-md dark:bg-gray-800 dark:text-gray-400">
                    <div class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg" :class="toastClasses(toast.type)">
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path :d="iconPath(toast.type)" />
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-normal">{{ toast.message }}</div>
                </div>
            </TransitionGroup>
        </div>
    </Teleport>
</template>
