<template>
    <Head :title="pageTitle" />

    <AuthenticatedLayout>
        <div class="py-12 grid px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-y-4 sm:gap-y-0">
                    <div class="flex items-center justify-start text-gray-500">
                        <TagIcon class="h-10 w-10 transition duration-75 mr-3" />
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
            <div class="py-4 lg:py-6 p-4 bg-white rounded-lg shadow">
                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Details
                    </h3>
                </div>
                <form @submit.prevent="submitForm()">
                    <div class="grid gap-4 md:grid-cols-2 sm:gap-6 mb-4">
                        <div class="">
                            <InputLabel
                                for="name"
                                value="Name"
                            />
                            <TextInput
                                id="name"
                                type="text"
                                class="mt-1 block w-full h-10"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="off"
                                placeholder="Type unit name"
                            />
                            <InputError class="mt-1" :message="form.errors.name" />
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2 sm:gap-6 mb-4">
                        <div class="">
                            <InputLabel
                                for="description"
                                value="Description"
                            />
                            <TextareaInput
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                placeholder="Type unit description"
                                rows="4"
                            />
                            <InputError class="mt-1" :message="form.errors.description" />
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-3 md:gap-2">
                        <PrimaryButton :disabled="form.processing">
                            Save
                        </PrimaryButton>
                        <DynamicLink
                            :href="'/' + url"
                            type="secondary"
                        >
                            Back
                        </DynamicLink>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { TagIcon } from '@heroicons/vue/24/solid'
import Breadcrumb from '@/Components/Breadcrumb.vue'
import TextInput from '@/Components/TextInput.vue'
import TextareaInput from '@/Components/TextareaInput.vue'
import InputLabel from '@/Components/InputLabel.vue'
import DynamicLink from '@/Components/DynamicLink.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Swal from 'sweetalert2'
import { router } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'

const moduleName = 'Units'
const url = 'units'
const pageTitle = 'Update Unit'

const props = defineProps({
    model: Object,
});

const form = useForm({
    id: props.model.id,
    name: props.model.name,
    description: props.model.description,
})

let submitForm = () => {
    form.patch(route(url + '.update', props.model.id), {
        preserveScroll: true,
        onSuccess: () => {
            router.get('/' + url)
            Swal.fire({
                title: 'Updated successfully',
                // text: "Created successfully.",
                icon: 'success',
                confirmButtonColor: '#16A34A',
            }).then(() => {
                //
            })
        },
    })
}
</script>
<style lang="">

</style>
