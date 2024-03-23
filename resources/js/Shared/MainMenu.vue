<template>
  <div class="z-40">
      <div class="flex flex-col  pt-6 pb-3">
          <div class="space-y-2">
              <jet-nav-link title="Dashboard"
                 class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium"
                            :href="route('dashboard')"  :active="route().current('dashboard')"><span class="transition gray-300"></span><Square2StackIcon class="w-5 h-5"/>
                  <span>Dashboard</span>
              </jet-nav-link>
          </div>
      </div>
      <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Borrower Management
          </div>
          <div class="space-y-2">
              <jet-dropdown>
                 <template #trigger>
                     <button type="button" class="flex items-center cursor-pointer w-full p-2 text-base font-normal text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100">
                         <UserIcon class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"/>
                         <span class="flex-1 ml-3 text-left whitespace-nowrap">Borrowers</span>
                         <ChevronDownIcon  class="w-4 h-4"/>
                     </button>
                 </template>
                  <template #content>
                      <div class="space-y-2 py-1.5">
                      <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href>View Borrowers</jet-nav-link>
                      </div>
                      <div class="space-y-2 py-1.5">
                      <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('borrow.create')" :active="route().current('borrow.create')">Add Borrower</jet-nav-link>
                      </div>
                      <div class="space-y-2 py-1.5">
                      <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href>Borrowers Group</jet-nav-link>
                      </div>
                      <div class="space-y-2 py-1.5">
                      <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href>Add Borrowers Group</jet-nav-link>
                      </div>
                  </template>
              </jet-dropdown>
          </div>
      </div>



  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import JetNavLink from '@/Components/NavLink.vue'
import JetDropdown from '@/Components/Dropdown.vue'
import JetDropdownLink from '@/Components/DropdownLink.vue'
import {UserIcon,ChevronDownIcon, UsersIcon, Square2StackIcon} from "@heroicons/vue/24/outline"



</script>
