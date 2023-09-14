<template>
    <div
        class="flex justify-end mb-4"
    >
        <div
            v-if="withDate"
            class="flex gap-x-4"
        >
            <div>
                <InputLabel
                    for="date-from"
                    value="From"
                />
                <TextInput
                    type="date"
                    id="date-from"
                    class="mt-1 block w-full h-10"
                    v-model="dateFrom"
                    required
                    autocomplete="off"
                    placeholder="Date From"
                />
            </div>
            <div>
                <InputLabel
                    for="date-until"
                    value="Until"
                />
                <TextInput
                    type="date"
                    id="date-until"
                    class="mt-1 block w-full h-10"
                    v-model="dateUntil"
                    required
                    autocomplete="off"
                    placeholder="Date Until"
                />
            </div>
        </div>
    </div>
    <div class="space-y-4 bg-white relative shadow-md rounded-lg overflow-hidden z-10">
        <div class="flex justify-between gap-y-4 px-4 pt-5 gap-x-10">
            <div class="flex items-center justify-center gap-x-2">
                <label for="per_page" class="block text-sm font-medium text-gray-700 dark:text-white whitespace-nowrap">Per Page</label>
                <select
                    v-model="currentPerPage"
                    id="per_page"
                    name="per_page"
                    autocomplete="per_page"
                    class="block w-full rounded-md border border-gray-300 bg-white dark:bg-gray-700 h-10 pl-3 pr-8 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm text-gray-700 dark:text-white"
                >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
            <div class="flex">
                <div class="flex md:w-80s w-auto group">
                    <TextInput
                        id="search"
                        type="text"
                        class="block w-full border-r-0 rounded-r-none ring-0 rounded-lg border h-10"
                        v-model="search"
                        required
                        placeholder="Search"
                        autocomplete="off"
                        @keyup.enter="searchRecords()"
                    />
                    <DynamicLink
                        type="success"
                        class="h-10 rounded-l-none"
                        title="Search"
                        @click="searchRecords()"
                    >
                        <MagnifyingGlassIcon
                            class="h-6 w-6"
                        />
                    </DynamicLink>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto mb-4">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th
                            v-for="header in tableHeader"
                            :key="header.title"
                            :class="header.class"
                            scope="col"
                        >
                            <button
                                type="button"
                                class="flex items-center gap-x-2"
                                @click="setOrderBy(header.column)"
                                :disabled="header.column == null"
                                :class="[header.column == orderBy ? 'text-blue-600 hover:text-blue-700' : 'hover:text-gray-900']"
                                :title="'Sort by ' + header.title"
                            >
                                {{ header.title }}
                                <ChevronUpDownIcon
                                    v-if="header.column != null"
                                    class="h-5 w-5"
                                />
                            </button>
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
            class="px-4 pb-4"
            :totalPages="props.response.last_page ?? 0"
            :perPage="parseInt(currentPerPage) ?? 0"
            :currentPage="props.response.current_page ?? 0"
            :from="props.response.from ?? 0"
            :to="props.response.to ?? 0"
            :total="props.response.total ?? 0"
            :url="props.url"
            :search="search"
            :orderBy="orderBy"
            :orderType="orderType"
            :dateFrom="dateFrom"
            :dateUntil="dateUntil"
        />
    </div>
</template>
<script setup>
import PaginationComponent from '@/Components/Table/Pagination.vue'
import { MagnifyingGlassIcon, ChevronUpDownIcon } from '@heroicons/vue/24/outline'
import { ref } from 'vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import DynamicLink from '@/Components/DynamicLink.vue'
import { router } from '@inertiajs/vue3'

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
    order: {
        type: Object,
        default: {
            orderBy: '',
            orderType: ''
        }
    },
    dateFrom: {
        type: String,
        default: '',
    },
    dateUntil: {
        type: String,
        default: '',
    },
    withDate: {
        type: Boolean,
        default: false,
    }
})

const currentPerPage = ref(JSON.parse(JSON.stringify(props.response.per_page ?? 10)))

const search = props.search != ''
    ? ref(JSON.parse(JSON.stringify(props.search)))
    : ref('')

const orderBy = props.order.orderBy != ''
    ? ref(JSON.parse(JSON.stringify(props.order.orderBy)))
    : ref('')

const orderType = props.order.orderType != ''
    ? ref(JSON.parse(JSON.stringify(props.order.orderType)))
    : ref('')

const dateFrom = props.dateFrom != ''
    ? ref(JSON.parse(JSON.stringify(props.dateFrom)))
    : ref('')

const dateUntil = props.dateUntil != ''
    ? ref(JSON.parse(JSON.stringify(props.dateUntil)))
    : ref('')

const setOrderBy = (column) => {
    if (orderBy.value != column) {
        orderBy.value = column
        orderType.value = ''
    } else {
        if (orderType.value == 'desc') {
            orderType.value = 'asc'
        } else {
            // reset values
            orderType.value = ''
            orderBy.value = ''
        }
    }
}

const searchRecords = () => {
    router.get(search.value ? '/' + props.url + '/?search=' + search.value : '/' + props.url)
}
</script>
<style lang="scss">
    .date-picker-input {
        @apply h-10 border-gray-300 shadow-sm text-sm placeholder:text-gray-400 focus:border-blue-600 focus:ring-blue-600 rounded-md w-auto;
    }
</style>
