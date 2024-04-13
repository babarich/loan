

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-4">
            <div class="max-w-full mx-auto sm:px-4 lg:px-4">
                <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
                    <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                                <i class="pi pi-clock  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Total Outstanding</span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(totalOutstanding)}}</span></div>
                        </div>
                    </div>
                    <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500  me-3">
                                <i class="pi pi-calendar-minus  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Principle  Outstanding </span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(principleOutstanding)}}</span></div>
                        </div>
                    </div>
                    <div class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-600  me-3">
                                <i class="pi pi-calendar-plus  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Interest Outstanding </span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(interestOut)}}</span></div>
                        </div>
                    </div>
                    <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">

                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                                <i class="pi pi-box  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Fully Paid Loans</span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{fully}}</span></div>
                        </div>
                    </div>
                </div>
                <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4 mt-4">
                    <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                                <i class="pi pi-users  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Total Borrowers</span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{borrowers}}</span></div>
                        </div>
                    </div>
                    <div
                        class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500  me-3">
                                <i class="pi pi-calendar-minus  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Penalty Outstanding </span><span
                                class="mb-2 text-2xl font-semibold text-heading">0</span></div>
                        </div>
                    </div>
                    <div class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-600  me-3">
                                <i class="pi pi-calendar-plus  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Open Loans </span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{open}}</span></div>
                        </div>
                    </div>
                    <div class="flex h-full w-full flex-col rounded-sm border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                        <div class="mb-auto flex w-full items-center justify-between">
                            <div
                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                                <i class="pi pi-user  text-2xl text-white text-center"></i>
                            </div>
                            <div class="flex w-full flex-col text-end"><span
                                class="mb-1 text-base font-normal text-body">Denied Loans </span><span
                                class="mb-2 text-2xl font-semibold text-heading">{{denied}}</span></div>
                        </div>
                    </div>
                </div>


                <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
                    <DashboardChard :chart-data="chartData"  :projected-data="projectedMonth" :interest-paid="interestPaid"
                           :interest-projected="interestProjected" :principle-paid="principlePaid" :principle-projected="principleProjected"/>


                </div>

            </div>

        </div>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {BanknotesIcon,UsersIcon,GiftTopIcon,CircleStackIcon} from '@heroicons/vue/24/outline'
import Chart from 'primevue/chart';

import { ref, onMounted } from "vue";
import DashboardChard from "@/Pages/Charts/DashboardChard.vue";



const props = defineProps({
    totalOutstanding:Object,principleOutstanding:Object,
    interestOut:Object,fully:Object,open:Object,borrowers:Object,
    denied:Object,chartData:Object,projectedMonth:Object,interestPaid:Object,
    interestProjected:Object,principlePaid:Object, principleProjected:Object
})



function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}


</script>
