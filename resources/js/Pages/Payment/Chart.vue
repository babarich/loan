

<template>
    <AppLayout>
        <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
            <div
                class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                        <i class="pi pi-clock  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Today's Collection</span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(today)}}</span></div>
                </div>
            </div>
            <div
                class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500  me-3">
                        <i class="pi pi-calendar-minus  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Last 7 days </span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(week)}}</span></div>
                </div>
            </div>
            <div class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-600  me-3">
                        <i class="pi pi-calendar-plus  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Last 30 days </span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(month)}}</span></div>
                </div>
            </div>
            <div
                class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6">

                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                        <i class="pi pi-box  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">All Time  Collection</span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(total)}}</span></div>
                </div>
            </div>
        </div>
        <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4 mt-4">
            <div
                class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                        <i class="pi pi-clock  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Total Interest</span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(interest)}}</span></div>
                </div>
            </div>
            <div
                class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-500  me-3">
                        <i class="pi pi-calendar-minus  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Total Principal </span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{formatCurrency(principle)}}</span></div>
                </div>
            </div>
            <div class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-600  me-3">
                        <i class="pi pi-calendar-plus  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Total Penalty </span><span
                        class="mb-2 text-2xl font-semibold text-heading">0</span></div>
                </div>
            </div>
            <div class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-white p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                <div class="mb-auto flex w-full items-center justify-between">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary  me-3">
                        <i class="pi pi-user  text-2xl text-white text-center"></i>
                    </div>
                    <div class="flex w-full flex-col text-end"><span
                        class="mb-1 text-base font-normal text-body">Total Loans </span><span
                        class="mb-2 text-2xl font-semibold text-heading">{{loan}}</span></div>
                </div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-12 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Monthly  Collection</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="chartData.width" :height="chartData.height" :type="chartData.type"
                                   :options="chartData.options" :series="chartData.series"></apexchart>
                    </div>
                </div>
            </div>
            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Monthly  Projection</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="projectedMonth.width" :height="projectedMonth.height" :type="projectedMonth.type"
                                   :options="projectedMonth.options" :series="projectedMonth.series"></apexchart>
                    </div>
                </div>
            </div>

            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Principle  Paid</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="principlePaid.width" :height="principlePaid.height" :type="principlePaid.type"
                                   :options="principlePaid.options" :series="principlePaid.series"></apexchart>
                    </div>
                </div>
            </div>


            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Principle  Projection</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="principleProjected.width" :height="principleProjected.height" :type="principleProjected.type"
                                   :options="principleProjected.options" :series="principleProjected.series"></apexchart>
                    </div>
                </div>
            </div>

            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Interest  Paid</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="interestPaid.width" :height="interestPaid.height" :type="interestPaid.type"
                                   :options="interestPaid.options" :series="interestPaid.series"></apexchart>
                    </div>
                </div>
            </div>


            <div
                class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
                        shadow-default  sm:px-7.5 xl:col-span-6">
                <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
                    <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                        <div class="w-full">
                            <p class="font-semibold text-red-500">Total Interest  Projection</p>
                        </div>
                    </div>

                </div>
                <div>
                    <div id="chartSix" class="-ml-5">
                        <apexchart :width="interestProjected.width" :height="interestProjected.height" :type="interestProjected.type"
                                   :options="interestProjected.options" :series="interestProjected.series"></apexchart>
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>

<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";

import {BanknotesIcon, CircleStackIcon, GiftTopIcon, UsersIcon} from "@heroicons/vue/24/outline";


function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}

const props = defineProps({
    today:Number, errors:Number,
    total:Number,week:Number, month:Number,principle:Number, interest:Number, loan:Number,
    chartData:Object, projectedMonth:Object, interestPaid:Object, principlePaid:Object,
    interestProjected:Object, principleProjected:Object
});



</script>


<style scoped>

</style>
