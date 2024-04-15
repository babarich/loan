<script setup>
import { ref } from 'vue';
import { Head, Link, router} from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MainMenu from '@/Shared/MainMenu.vue';
import {BellIcon,Bars3Icon} from '@heroicons/vue/24/outline'
import FlashMessages from "@/Shared/FlashMessages.vue";
import DropDownOld from "@/Components/DropDownOld.vue";




const target = ref(null)
const dropdownOpen = ref(false)




defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};[]


const emit = defineEmits(['toggle-sidebar'])

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="bg-gray-100">
        <div id="dropdown" />
        <div class="md:flex md:flex-col">
            <div class="md:flex md:flex-col md:h-screen">
                <div class="md:flex md:flex-shrink-0">
                    <div class="flex items-center justify-between px-6 py-4 bg-secondary  border-r  md:flex-shrink-0 md:justify-center md:w-72">
                        <div class="shrink-0 flex items-center">
                            <Link :href="route('dashboard')" class="flex">
                                <span class="text-white font-bold text-xl uppercase">MINAJO LTD</span>
                            </Link>
                        </div>
                        <dropdown class="md:hidden" placement="bottom-end">
                            <template #default>
                                <svg class="w-6 h-6 fill-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
                            </template>
                            <template #dropdown>
                                <div class="mt-2 px-8 py-4 bg-indigo-800 rounded shadow-lg">
                                    <main-menu />
                                </div>
                            </template>
                        </dropdown>
                    </div>
                    <div class="md:text-md flex items-center justify-between p-4 w-full text-sm bg-white border-b  md:px-12 md:py-0">
                        <div class="flex">
                            <button @click="emit('toggle-sidebar')"
                                    class="flex items-center justify-center rounded transition-colors w-8 h-8 text-gray-700 hover:bg-black/10 mr-5">
                                <Bars3Icon class="w-6"/>
                            </button>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </div>
                                <input type="text"  class="w-80 text-sm border-gray-200 pl-10 rounded-full" placeholder="Search..."/>
                            </div>
                        </div>





                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="rounded-full bg-gray-100 p-2">
                                <BellIcon class="w-5 h-5 text-primary" />
                            </div>
                            <!-- Settings Dropdown -->
                            <div class="ml-3">
                                <DropDownOld align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                       <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                    {{ $page.props.auth.user.name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </span>
                                    </template>

                                    <template #content>
                                        <div class="border-t border-gray-200" />
                                        <!-- Authentication -->
                                        <ul class="flex flex-col gap-5 border-b border-stroke px-6 py-7">
                                            <li>
                                                <jet-nav-link
                                                    class="flex items-center gap-3.5 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">

                                                    <i class="pi pi-user"></i> My Profile
                                                </jet-nav-link>
                                            </li>

                                        </ul>
                                        <form @submit.prevent="logout">
                                            <button
                                                class="flex items-center gap-3.5 py-4 px-6 text-sm font-medium duration-300 ease-in-out hover:text-primary lg:text-base">

                                                <i class="pi pi-lock"></i> Log Out
                                            </button>
                                        </form>
                                    </template>
                                </DropDownOld>
                            </div>



                        </div>
                    </div>



                </div>

                <div class="md:flex md:flex-grow md:overflow-hidden">
                    <main-menu class="hidden flex-shrink-0 p-4 w-72 bg-secondary  border-r overflow-y-auto md:block overflow-x-hidden"/>
                    <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region>
                        <slot />

                    </div>

                </div>
            </div>
        </div>
    </div>
    <FlashMessages/>
</template>
