<template>
    <div class="hidden md:block">
        <div class="w-64 h-screen"></div>
        <aside
            class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-300 md:translate-x-0 shadow-lg"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div class="overflow-y-auto py-5 px-3 h-full bg-white">
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/dashboard"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <PresentationChartBarIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">Dashboard</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/dashboard"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <ShoppingCartIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">POS</span>
                        </Link>
                    </li>
                </ul>

                <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                    <li>
                        <Link
                            href="/products"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <ShoppingBagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">Products</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/categories"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <TagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">Categories</span>
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/units"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <TagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">Units</span>
                        </Link>
                    </li>
                </ul>

                <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                    <li>
                        <Link
                            href="/dashboard"
                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                            <UsersIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                            <span class="ml-3">Users</span>
                        </Link>
                    </li>
                </ul>
            </div>
        </aside>
    </div>
    <div>
        <TransitionRoot as="template" :show="sidebar.status">
            <Dialog as="div" class="relative md:hidden z-30" @close="sidebar.close()">
                <TransitionChild
                    as="template"
                    enter="ease-in-out duration-500"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="ease-in-out duration-500"
                    leave-from="opacity-100"
                    leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-hidden">
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="pointer-events-none fixed inset-y-0 top-0 left-0 flex max-w-full pr-10">
                            <TransitionChild
                                as="template"
                                enter="transform transition ease-in-out duration-500 sm:duration-700"
                                enter-from="-translate-x-full"
                                enter-to="-translate-x-0"
                                leave="transform transition ease-in-out duration-500 sm:duration-700"
                                leave-from="-translate-x-0"
                                leave-to="-translate-x-full"
                            >
                                <DialogPanel class="pointer-events-auto relative w-screen max-w-md">
                                    <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                                        <div class="px-4 sm:px-6 flex items-center justify-between">
                                            <div class="flex items-center justify-between mr-4">
                                                <img src="https://flowbite.s3.amazonaws.com/logo.svg" class="mr-3 h-8" alt="Flowbite Logo" />
                                                <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
                                            </div>
                                            <button type="button" class="relative rounded-md text-gray-400 hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white" @click="sidebar.close()">
                                                <span class="absolute" />
                                                <span class="sr-only">Close panel</span>
                                                <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                            </button>
                                        </div>
                                        <div class="relative mt-2 flex-1 px-4 sm:px-6">
                                            <aside
                                                class=""
                                                aria-label="Sidenav"
                                                id="drawer-navigation"
                                            >
                                                <div class="overflow-y-auto py-5 h-full bg-white">
                                                    <ul class="space-y-2">
                                                        <li>
                                                            <Link
                                                                href="/dashboard"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <PresentationChartBarIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">Dashboard</span>
                                                            </Link>
                                                        </li>
                                                        <li>
                                                            <Link
                                                                href="/dashboard"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <ShoppingCartIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">POS</span>
                                                            </Link>
                                                        </li>
                                                    </ul>

                                                    <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                                                        <li>
                                                            <Link
                                                                href="/products"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <ShoppingBagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">Products</span>
                                                            </Link>
                                                        </li>
                                                        <li>
                                                            <Link
                                                                href="/categories"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <TagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">Categories</span>
                                                            </Link>
                                                        </li>
                                                        <li>
                                                            <Link
                                                                href="/units"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <TagIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">Units</span>
                                                            </Link>
                                                        </li>
                                                    </ul>

                                                    <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200">
                                                        <li>
                                                            <Link
                                                                href="/dashboard"
                                                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                                <UsersIcon class="h-6 w-6 text-gray-600 transition duration-75 group-hover:text-gray-900" />
                                                                <span class="ml-3">Users</span>
                                                            </Link>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </aside>
                                        </div>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
    import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
    import { XMarkIcon, ShoppingBagIcon, ShoppingCartIcon, PresentationChartBarIcon, TagIcon, UsersIcon } from '@heroicons/vue/24/outline'
    import { useSidebarStore } from '@/stores/sidebar'
    import { Link } from '@inertiajs/vue3';

    const sidebar = useSidebarStore()
</script>
