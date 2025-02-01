<script setup lang="ts">
import TrFoot from '@/Components/Table/TFoot/Tr.vue';

import TrHead from '@/Components/Table/THead/Tr.vue';
import { useSlots } from 'vue';

const slots = useSlots();
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400 rtl:text-right">
            <caption v-if="slots.header" class="bg-white p-5 text-left text-lg font-semibold text-gray-900 dark:bg-gray-800 dark:text-white rtl:text-right">
                <slot name="header"></slot>
            </caption>

            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <TrHead>
                    <slot name="thead"></slot>
                </TrHead>
            </thead>

            <tbody>
                <slot name="tbody"></slot>
            </tbody>

            <tfoot>
                <TrFoot>
                    <slot name="tfoot"></slot>
                </TrFoot>
            </tfoot>
        </table>
    </div>
</template>
