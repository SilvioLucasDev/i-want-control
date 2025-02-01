<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import Calendar, { SelectDate } from '@/Components/Calendar.vue';

import Table from '@/Components/Table/Table.vue';
import TdBody from '@/Components/Table/TBody/Td.vue';
import ThBody from '@/Components/Table/TBody/Th.vue';
import TrBody from '@/Components/Table/TBody/Tr.vue';
import ThHead from '@/Components/Table/THead/Th.vue';

const fetchData = ({ month, year }: SelectDate) => {
    console.log(`DASHBOARD :: Fetching data for: ${month} / ${year}`);
};
</script>

<template>
    <Head title="Dashboard" />

    <Calendar @select-date="fetchData" />

    <div class="flex flex-col gap-4 md:flex-row">
        <div class="w-full">
            <Table>
                <template #header>
                    Our products
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                </template>

                <template #thead>
                    <ThHead>Product name</ThHead>
                    <ThHead>Color</ThHead>
                    <ThHead>Category</ThHead>
                    <ThHead>Price</ThHead>
                    <ThHead screenReaderOnly> Edit </ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Apple MacBook Pro 17"</ThBody>
                        <TdBody>Silver</TdBody>
                        <TdBody>Laptop</TdBody>
                        <TdBody>$2999</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Microsoft Surface Pro</ThBody>
                        <TdBody>White</TdBody>
                        <TdBody>Laptop PC</TdBody>
                        <TdBody>$1999</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>

                    <TrBody>
                        <ThBody>Magic Mouse 2</ThBody>
                        <TdBody>Black</TdBody>
                        <TdBody>Accessories</TdBody>
                        <TdBody>$99</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>
                </template>
            </Table>
        </div>
        <div class="w-full">
            <Table>
                <template #header>
                    Our products
                    <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of Flowbite products designed to help you work and play, stay organized, get answers, keep in touch, grow your business, and more.</p>
                </template>

                <template #thead>
                    <ThHead>Product name</ThHead>
                    <ThHead>Color</ThHead>
                    <ThHead>Category</ThHead>
                    <ThHead>Price</ThHead>
                    <ThHead screenReaderOnly> Edit </ThHead>
                </template>

                <template #tbody>
                    <TrBody withBorder>
                        <ThBody>Apple MacBook Pro 17"</ThBody>
                        <TdBody>Silver</TdBody>
                        <TdBody>Laptop</TdBody>
                        <TdBody>$2999</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>

                    <TrBody withBorder>
                        <ThBody>Microsoft Surface Pro</ThBody>
                        <TdBody>White</TdBody>
                        <TdBody>Laptop PC</TdBody>
                        <TdBody>$1999</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>

                    <TrBody>
                        <ThBody>Magic Mouse 2</ThBody>
                        <TdBody>Black</TdBody>
                        <TdBody>Accessories</TdBody>
                        <TdBody>$99</TdBody>
                        <TdBody class="text-right">
                            <a href="#" class="font-medium text-blue-600 hover:underline dark:text-blue-500">Edit</a>
                        </TdBody>
                    </TrBody>
                </template>
            </Table>
        </div>
    </div>
</template>
