<template>
  <div class="">
      <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Menu
          </div>
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
          <div class="space-y-2 py-1.5" >
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('borrow.index')" :active="route().current('borrow.index')">
                  <i class="pi pi-user flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Borrowers</span>
              </jet-nav-link>
          </div>

          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium" :href="route('group.index')" :active="route().current('group.index')">
                  <i class="pi pi-users flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Borrowers Group</span>
              </jet-nav-link>
          </div>
          <div class="space-y-2">
              <jet-dropdown>
                 <template #trigger>
                     <button type="button" class="flex px-4 items-center cursor-pointer w-full p-2 text-base font-normal
                     text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100">
                         <i class="pi pi-box flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                         <span class="flex-1 ml-3 text-left whitespace-nowrap">Loans</span>
                         <ChevronDownIcon  class="w-4 h-4"/>
                     </button>
                 </template>
                  <template #content>
                          <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium
                           relative  before:absolute before:-left-0.5 before:top-[18px] before:h-px before:w-3
                          before:border-t before:border-dashed before:border-gray-600"
                                             :href="route('loan.index')"
                                             :active="route().current('loan.index')" >
                              <span class="flex-1 ml-3 text-left whitespace-nowrap">Loans</span>
                          </jet-nav-link>

                          <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium
                            relative  before:absolute before:-left-0.5 before:top-[18px] before:h-px before:w-3
                          before:border-t before:border-dashed before:border-gray-600"
                                             :href="route('guarantor.index')"
                                             :active="route().current('guarantor.index')" >
                              <span class="flex-1 ml-3 text-left whitespace-nowrap">Guarantors</span>
                          </jet-nav-link>
                          <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium
                          relative  before:absolute before:-left-0.5 before:top-[18px] before:h-px before:w-3
                          before:border-t before:border-dashed before:border-gray-600" :href="route('product.index')"
                                        :active="route().current('product.index')" >
                              <span class="flex-1 ml-3 text-left whitespace-nowrap">Loan Products</span>
                          </jet-nav-link>


                  </template>
              </jet-dropdown>
          </div>
      </div>


      <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Payment Management
          </div>
          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium">
                  <i class="pi pi-user flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Repayment</span>
              </jet-nav-link>
          </div>

          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium">
                  <i class="pi pi-users flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Repayment Chart</span>
              </jet-nav-link>
          </div>
          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium">
                  <i class="pi pi-users flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Approve Repayment</span>
              </jet-nav-link>
          </div>

      </div>

      <div class="flex flex-col  pt-6 pb-3">
          <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">Collection Management
          </div>
          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium">
                  <i class="pi pi-user flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Collection Sheet</span>
              </jet-nav-link>
          </div>

          <div class="space-y-2 py-1.5">
              <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium">
                  <i class="pi pi-users flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                  <span class="flex-1 ml-3 text-left whitespace-nowrap">Missed Payment </span>
              </jet-nav-link>
          </div>
          <div class="flex flex-col  pt-6 pb-3">
              <div class="pb-5 text-xs font-semibold  tracking-[0.05em]  text-gray-500">General Settings
              </div>
          <div class="space-y-2">
              <jet-dropdown>
                  <template #trigger>
                      <button type="button" class="flex px-4 items-center cursor-pointer w-full p-2 text-base font-normal
                     text-gray-500 transition duration-75 rounded-lg group hover:bg-gray-100">
                          <i class="pi pi-sliders-h flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900"></i>
                          <span class="flex-1 ml-3 text-left whitespace-nowrap">Settings</span>
                          <ChevronDownIcon  class="w-4 h-4"/>
                      </button>
                  </template>
                  <template #content>
                      <jet-nav-link class="group flex w-full items-center gap-2.5 rounded-md px-4
                  py-2.5 text-md text-gray-300 text-start focus:text-primary hover:bg-gray-100 font-medium
                          relative  before:absolute before:-left-0.5 before:top-[18px] before:h-px before:w-3
                          before:border-t before:border-dashed before:border-gray-600" :href="route('collateraltype.index')"
                                    :active="route().current('collateraltype.index')" >
                          <span class="flex-1 ml-3 text-left whitespace-nowrap">Collateral Types</span>
                      </jet-nav-link>
                  </template>
              </jet-dropdown>
          </div>
              </div>
      </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import JetNavLink from '@/Components/NavLink.vue'
import SideLink from "@/Components/SideLink.vue";
import JetDropdown from '@/Components/Dropdown.vue'
import JetDropdownLink from '@/Components/DropdownLink.vue'
import {UserIcon,ChevronDownIcon, UsersIcon, Square2StackIcon} from "@heroicons/vue/24/outline"

</script>
