<template>
    <Head :title="pageTitle" />

    <AuthenticatedLayout>
        <div class="pt-12 pb-12 grid px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-y-4 sm:gap-y-0">
                    <div class="flex items-center justify-start text-gray-500">
                        <TruckIcon class="h-10 w-10 transition duration-75 mr-3" />
                        <h1 class="text-3xl">{{ pageTitle }}</h1>
                    </div>
                </div>
                <div>
                    <Breadcrumb
                        :links="[
                            {
                                link: url,
                                title: moduleName
                            }
                        ]"
                        :current="pageTitle"
                    />
                </div>
            </div>
            <form @submit.prevent="submitForm()" enctype="multipart/form-data">
                <div
                    class="bg-white grid rounded-lg shadow mb-5"
                >
                    <TabGroup
                        :selectedIndex="selectedTabIndex"
                        @change="changeTab"
                    >
                        <TabList class="items-center w-full flex border-b h-16">
                            <Tab
                                v-for="(item, index) in tabHeaders"
                                :key="index"
                                v-slot="{ selected }"
                                class="w-full flex justify-between items-center focus:outline-none"
                                :disabled="item.disabled"
                            >
                                <div class="flex items-center py-4 space-x-2.5 font-medium text-gray-500 sm:text-base px-6">
                                    <div
                                        v-if="index < selectedTabIndex"
                                        class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center"
                                    >
                                        <CheckIcon
                                            class="h-5 w-5 text-white"
                                        />
                                    </div>
                                    <span
                                        v-else
                                        class="flex items-center justify-center w-8 h-8 border border-blue-600 rounded-full shrink-0"
                                        :class="[
                                            selected ? 'text-blue-600 border-blue-600' : 'border-gray-600'
                                        ]"
                                    >
                                        {{ index + 1 }}
                                    </span>
                                    <span
                                        class="text-left"
                                        :class="[
                                            selected ? 'text-blue-600' : ''
                                        ]"
                                    >
                                        <h3 class="font-medium leading-tight">{{ item.title }}</h3>
                                    </span>
                                </div>
                                <!-- Tab divider -->
                                <div
                                    v-if="index != tabHeaders.length-1"
                                    class="w-4 h-16"
                                >
                                    <svg fill="none" preserveAspectRatio="none" viewBox="0 0 22 80" class="h-full w-full text-gray-200 rtl:rotate-180 dark:text-white/5">
                                        <path d="M0 -2L20 40L0 82" stroke-linejoin="round" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
                                    </svg>
                                </div>
                            </Tab>
                        </TabList>
                        <TabPanels>
                            <TabPanel
                                class="rounded-xl bg-white py-4 px-6 focus:outline-none"
                                :unmount="false"
                            >
                                <div class="grid lg:grid-cols-2 gap-4 mb-5">
                                    <div class="col-span-1">
                                        <InputLabel
                                            for="purchase_date"
                                            value="Purchase Date"
                                        />
                                        <TextInput
                                            id="purchase_date"
                                            type="date"
                                            class="mt-1 block w-full h-10"
                                            v-model="form.purchase_date"
                                            required
                                            autofocus
                                            autocomplete="off"
                                            placeholder="Purchase Date"
                                        />
                                        <InputError class="mt-1" :message="form.errors.purchase_date" />
                                    </div>
                                </div>
                                <div class="grid lg:grid-cols-2 gap-4 mb-5">
                                    <div class="col-span-1">
                                        <InputLabel
                                            for="supplier_id"
                                            value="Supplier"
                                        />
                                        <ComboBox
                                            ajaxUrl="/search-suppliers?search="
                                            v-on:update:model-value="form.supplier_id = !!$event ? $event.id : ''"
                                            class="mt-1"
                                        />
                                        <InputError class="mt-1" :message="form.errors.supplier_id" />
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <DynamicLink
                                        :href="'/' + url"
                                        type="secondary"
                                    >
                                        Cancel
                                    </DynamicLink>
                                    <PrimaryButton
                                        type="button"
                                        @click="nextTab()"
                                    >
                                        Next
                                    </PrimaryButton>
                                </div>
                            </TabPanel>
                            <TabPanel
                                class="rounded-xl bg-white py-4 px-6 focus:outline-none"
                                :unmount="false"
                            >
                                <div
                                    v-for="(item, index) in form.purchase_items"
                                    :key="index"
                                >
                                    <div
                                        v-if="!item.deleted"
                                        class="border rounded-lg mb-4"
                                    >
                                        <div class="lg:col-span-12 border-b flex items-centers px-4 py-3">
                                            <div class="text-gray-500">
                                                <!-- #{{ index + 1 }} -->
                                            </div>
                                            <div class="ms-auto">
                                                <button
                                                    type="button"
                                                    class="flex items-center"
                                                    @click="removeItem(index)"
                                                    :disabled="!showRemoveButton"
                                                >
                                                    <TrashIcon
                                                        class="h-5 w-5"
                                                        :class="[showRemoveButton ? 'text-red-500 hover:text-red-600' : 'text-gray-400']"
                                                    />
                                                </button>
                                            </div>
                                        </div>
                                        <div class="grid lg:grid-cols-12 gap-6 px-4 py-3">
                                            <div class="lg:col-span-6 relative">
                                                <InputLabel
                                                    :for="'product_id_' + index"
                                                    value="Product"
                                                />
                                                <ComboBox
                                                    :id="'product_id_' + index"
                                                    ajaxUrl="/search-products?search="
                                                    v-on:update:model-value="item.product_id = !!$event ? $event.id : ''"
                                                    class="mt-1"
                                                    required
                                                />

                                                <InputError class="mt-1" :message="form.errors['purchase_items.'+ index +'.product_id']" />
                                            </div>
                                            <div class="lg:col-span-2">
                                                <InputLabel
                                                    :for="'quantity_' + index"
                                                    value="Quantity"
                                                />
                                                <TextInput
                                                    :id="'quantity_' + index"
                                                    type="number"
                                                    min="1"
                                                    class="mt-1 block w-full h-10"
                                                    v-model="item.quantity"
                                                    required
                                                    autocomplete="off"
                                                    placeholder="Purchase Date"
                                                    @input="calculateEachItemTotal(index)"
                                                />
                                                <InputError class="mt-1" :message="form.errors['purchase_items.'+ index +'.quantity']" />
                                            </div>
                                            <div class="lg:col-span-2">
                                                <InputLabel
                                                    :for="'unit_cost_' + index"
                                                    value="Cost"
                                                />
                                                <TextInput
                                                    :id="'unit_cost_' + index"
                                                    type="number"
                                                    min="1"
                                                    step=".01"
                                                    class="mt-1 block w-full h-10"
                                                    v-model="item.unit_cost"
                                                    required
                                                    autocomplete="off"
                                                    placeholder="Cost"
                                                    @input="calculateEachItemTotal(index)"
                                                />
                                                <InputError class="mt-1" :message="form.errors['purchase_items.'+ index +'.quantity']" />
                                            </div>
                                            <div class="lg:col-span-2">
                                                <InputLabel
                                                    :for="'total_' + index"
                                                    value="Total"
                                                />
                                                <TextInput
                                                    :id="'total_' + index"
                                                    type="text"
                                                    class="mt-1 block w-full h-10 bg-slate-100"
                                                    v-model="item.total"
                                                    required
                                                    disabled
                                                    autocomplete="off"
                                                    placeholder="Purchase Date"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <button
                                        type="button"
                                        class="uppercase text-sm font-bold py-2 px-4 border rounded-lg text-green-600 hover:text-green-700 border-green-600 hover:border-green-700 flex items-center gap-x-1"
                                        @click="addItem()"
                                    >
                                        <PlusIcon class="h-4 w-4" />
                                        Add item
                                    </button>
                                </div>
                                <div class="flex justify-between">
                                    <SecondaryButton
                                        type="button"
                                        @click="prevTab()"
                                    >
                                        Back
                                    </SecondaryButton>
                                    <PrimaryButton
                                        @click="nextTab()"
                                    >
                                        Save
                                    </PrimaryButton>
                                </div>
                            </TabPanel>
                        </TabPanels>
                    </TabGroup>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import {
    TruckIcon,
    PlusIcon,
    TrashIcon,
    CheckIcon,
} from '@heroicons/vue/24/solid'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import TextInput from '@/Components/TextInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import { ref, watch } from 'vue'
import ComboBox from '@/Components/ComboBox.vue'
import DynamicLink from '@/Components/DynamicLink.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import {
    TabGroup,
    TabList,
    Tab,
    TabPanels,
    TabPanel
} from '@headlessui/vue'

const moduleName = 'Purchases'
const url = 'purchases'
const pageTitle = 'Create Purchase'

const props = defineProps({
    suppliers: Array,
    categories: Array,
});

const form = useForm({
    purchase_date: '',
    supplier_id: '',
    category_id: '',
    purchase_items: [{
        product_id: '',
        quantity: '1',
        unit_cost: '',
        total: '0.00',
        deleted: false,
    }],
})

const productErrorMessage = ref(null)
const showRemoveButton = ref(false)

// Use for watcher, update form.category_id when value changes
const category_id = ref('')

// Products by category
const products = ref([])

// Currently selected product from listbox
const selectedProduct = ref(null)

// Resets product items when category changes
const resetProductIndex = ref(false)

watch(category_id, (newValue, oldValue) => {
    getProductsByCategory(newValue)
    form.category_id = newValue
    resetProductIndex.value = true
    selectedProduct.value = null
    productErrorMessage.value = null
})

watch(selectedProduct, (newValue, oldValue) => {
    productErrorMessage.value = null
})

let calculateEachItemTotal = (index) => {
    let item = form.purchase_items[index]
    form.purchase_items[index].total = (parseInt(item.quantity == '' ? 0 : item.quantity) * parseFloat(item.unit_cost == '' ? 0 : item.unit_cost)).toFixed(2).toString()
}

let submitForm = () => {
    form.post(route(url + '.store'), {
        preserveScroll: true,
        onSuccess: () => {
            router.get('/' + url)
            Swal.fire({
                title: 'Created successfully',
                // text: "Created successfully.",
                icon: 'success',
                confirmButtonColor: '#16A34A',
            }).then(() => {
                //
            })
        },
    })
}

let getProductsByCategory = (category_id) => {
    if (category_id != null) {
        axios.get('/products-list/' + category_id)
            .then(function (response) {
                products.value = response.data
            })
    } else {
        selectedProduct.value = null
        products.value = []
    }
}

let addItem = () => {
    form.purchase_items.push({
        product_id: '',
        quantity: '1',
        unit_cost: '',
        total: '0.00',
        deleted: false,
    })

    showRemoveButton.value = true
}

let removeItem = (index) => {
    Swal.fire({
        title: 'Remove item?',
        // text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Remove'
    }).then((result) => {
        if (result.isConfirmed) {
            form.purchase_items[index].deleted = true

            // Hide remove button when only one item left
            let purchaseArray = form.purchase_items.filter((item) => item.deleted == false)
            if (purchaseArray.length == 1) {
                showRemoveButton.value = false
            }
        }
    })
}

/******** Tabs Properties ********/

const selectedTabIndex = ref(0)

const changeTab = (index) => {
    // selectedTabIndex.value = index
    if (index > selectedTabIndex.value) {
        nextTab()
    } else {
        prevTab()
    }
}

const prevTab = () => {
    if (selectedTabIndex.value > 0) {
        selectedTabIndex.value -= 1
    }
}

const nextTab = () => {
    if (tabHeaders.value.length - 1 > selectedTabIndex.value) {
        let hasError = false

        // Validate form fields
        if (form.purchase_date == '') {
            form.errors.purchase_date = "The purchase date field is required."
            hasError = true
        } else {
            delete form.errors.purchase_date
        }

        if (form.supplier_id == '') {
            form.errors.supplier_id = "The supplier id field is required."
            hasError = true
        } else {
            delete form.errors.supplier_id
        }

        // Next tab if no errror
        if (!hasError) {
            selectedTabIndex.value += 1
        }
    }
}

const tabHeaders = ref([
    {
        title: "Purchase Details",
        disabled: false,
    },
    {
        title: "Purchase Items",
        disabled: false,
    },
])

</script>
