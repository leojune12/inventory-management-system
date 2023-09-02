<template>
    <div class="hidden md:block">
        <div class="w-64 h-screen"></div>
        <aside
            class="fixed top-16 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0"
            aria-label="Sidenav"
            id="drawer-navigation"
        >
            <div class="overflow-y-auto py-5 px-3 h-full bg-white">
                <ul class="space-y-2">
                    <li>
                        <a
                        href="#"
                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                        >
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                        </svg>
                        <span class="ml-3">Overview</span>
                        </a>
                    </li>
                </ul>

                <ul
                class="pt-5 mt-5 space-y-2 border-t border-gray-200"
                >
                <li>
                    <a
                    href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 group"
                    >
                    <svg
                        aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path
                        fill-rule="evenodd"
                        d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                        clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="ml-3">Docs</span>
                    </a>
                </li>
                <li>
                    <a
                    href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100"
                    >
                    <svg
                        aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                        ></path>
                    </svg>
                    <span class="ml-3">Components</span>
                    </a>
                </li>
                <li>
                    <a
                    href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100"
                    >
                    <svg
                        aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                        clip-rule="evenodd"
                        ></path>
                    </svg>
                    <span class="ml-3">Help</span>
                    </a>
                </li>
                </ul>
            </div>
        </aside>
    </div>
    <div>
        <TransitionRoot as="template" :show="sidebar.status">
            <Dialog as="div" class="relative md:hidden z-10" @close="sidebar.close()">
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
                        <div class="pointer-events-none fixed inset-y-0 top-16 left-0 flex max-w-full pr-10">
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
                                        <div class="px-4 sm:px-6 flex items-center justify-end">
                                            <div class="flex">
                                                <button type="button" class="relative rounded-md text-gray-400 hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white" @click="sidebar.close()">
                                                    <span class="absolute" />
                                                    <span class="sr-only">Close panel</span>
                                                    <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                                </button>
                                            </div>
                                        </div>
                                        <div class="relative mt-2 flex-1 px-4 sm:px-6">
                                            <aside
                                                class=""
                                                aria-label="Sidenav"
                                                id="drawer-navigation"
                                            >
                                                <div class="overflow-y-auto py-5 px-3 h-full bg-white">
                                                    <ul class="space-y-2">
                                                        <li>
                                                            <a
                                                            href="#"
                                                            class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg hover:bg-gray-100 group"
                                                            >
                                                            <svg
                                                                aria-hidden="true"
                                                                class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                                                fill="currentColor"
                                                                viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                                            </svg>
                                                            <span class="ml-3">Overview</span>
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <ul
                                                    class="pt-5 mt-5 space-y-2 border-t border-gray-200"
                                                    >
                                                    <li>
                                                        <a
                                                        href="#"
                                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100"
                                                        >
                                                        <svg
                                                            aria-hidden="true"
                                                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                            <path
                                                            fill-rule="evenodd"
                                                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                            clip-rule="evenodd"
                                                            ></path>
                                                        </svg>
                                                        <span class="ml-3">Docs</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                        href="#"
                                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100"
                                                        >
                                                        <svg
                                                            aria-hidden="true"
                                                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"
                                                            ></path>
                                                        </svg>
                                                        <span class="ml-3">Components</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a
                                                        href="#"
                                                        class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100"
                                                        >
                                                        <svg
                                                            aria-hidden="true"
                                                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
                                                            fill="currentColor"
                                                            viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                        >
                                                            <path
                                                            fill-rule="evenodd"
                                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                                                            clip-rule="evenodd"
                                                            ></path>
                                                        </svg>
                                                        <span class="ml-3">Help</span>
                                                        </a>
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
    import { XMarkIcon } from '@heroicons/vue/24/outline'
    import { useSidebarStore } from '../stores/sidebar'

    const sidebar = useSidebarStore()
</script>
