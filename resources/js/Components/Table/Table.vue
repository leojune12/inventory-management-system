<template>
    <div class="space-y-4 bg-white relative shadow-md rounded-lg overflow-hidden z-10">
        <div class="flex justify-between gap-y-4 px-4 pt-5 gap-x-10">
            <div class="flex items-center justify-center gap-x-2">
                <label for="per_page" class="block text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">Per Page</label>
                <select
                    v-model="currentPerPage"
                    id="per_page"
                    name="per_page"
                    autocomplete="per_page"
                    class="block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 h-10 pl-3 pr-8 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm text-gray-700 dark:text-white md:w-16"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="flex md:w-80s w-auto">
                <TextInput
                    id="id_number"
                    type="text"
                    class="block w-full border-r-0 rounded-r-none ring-0 rounded-lg border-2 h-10"
                    v-model="search"
                    required
                    autocomplete="id_number"
                    placeholder="Search"
                />
                <DynamicLink
                    :href="search ? '/' + props.url + '/?search=' + search : '/' + props.url"
                    type="success"
                    class="h-10 rounded-l-none"
                    title="Search"
                >
                    <MagnifyingGlassIcon
                        class="h-6 w-6"
                    />
                </DynamicLink>
            </div>
        </div>
        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th
                            v-for="header in tableHeader"
                            :key="header.title"
                            :class="header.class"
                            scope="col"
                        >
                            {{ header.title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <slot name="tr">
                    </slot>
                </tbody>
            </table>
        </div>
        <PaginationComponent
            :totalPages="props.response.last_page ?? 0"
            :perPage="parseInt(currentPerPage) ?? 0"
            :currentPage="props.response.current_page ?? 0"
            :from="props.response.from ?? 0"
            :to="props.response.to ?? 0"
            :total="props.response.total ?? 0"
            :url="props.url"
            :search="search"
            class="px-4 pb-4"
        />
    </div>
</template>
<script setup>
import PaginationComponent from '@/Components/Table/Pagination.vue'
import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import TextInput from '@/Components/TextInput.vue'
import DynamicLink from '@/Components/DynamicLink.vue'

const props = defineProps({
    response: Object,
    search: {
        type: String,
        default: '',
    },
    url: {
        type: String,
        default: ''
    },
    tableHeader: Object,
})

const currentPerPage = ref(JSON.parse(JSON.stringify(props.response.per_page ?? 10)))

const search = props.search != '' ? ref(JSON.parse(JSON.stringify(props.search))) : ref('')
</script>
<style lang="">

</style>
