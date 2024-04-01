<template>
<AppLayout>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>

        </div>
        <div>
            <a :href="route('borrow.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                <ArrowLeftIcon class="w-4 h-4 mr-2"/>  Back
            </a>
        </div>
    </div>
    <div class="bg-gray-100">
        <div class="container mx-auto py-8">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="m-10 max-w-sm">
                                <div class="relative mx-auto w-52 rounded-full">
                                    <img :src="loan.borrower.filename" class="object-cover h-52 bg-gray-300 rounded-md mb-4 shrink-0" :alt="loan.borrower.first_name" />
                                </div>
                                <h1 class="my-1 text-center text-xl font-bold leading-8 text-gray-900">{{uppercase(loan.borrower.first_name)}} {{uppercase(loan.borrower.last_name)}}</h1>
                                <h3 class="font-lg text-semibold text-center leading-6 text-gray-600">{{loan.borrower.business_name}}, {{loan.borrower.working_status}}</h3>
                                <ul class="mt-3 divide-y rounded bg-gray-100 py-2 px-3 text-gray-600 shadow-sm hover:text-gray-700 hover:shadow">
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Age</span>
                                        <span class="ml-auto">{{formatDate(loan.borrower.date_birth)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Gender</span>
                                        <span class="ml-auto">{{uppercase(loan.borrower.gender)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Joined On</span>
                                        <span class="ml-auto">{{formatDate(loan.borrower.created_at)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Loan Officer</span>
                                        <span class="ml-auto">{{loan.user.name}}</span>
                                    </li>
                                </ul>

                        </div>


                    </div>
                </div>
                <div class="w-full md:w-2/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Loan Information</h2>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Loan Product</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.product.name}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">City</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.city}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Mobile</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.mobile}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Email</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.email}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Description</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.description}}</span>
                            </p>
                        </div>
                        <h2 class="text-xl font-bold mb-4">Borrower Files</h2>
                        <div class="bg-white relative overflow-x-auto mt-4">
                            <table class="w-full text-sm whitespace-nowrap">
                                <thead class="sticky top-0">
                                <tr>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        S/N
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        File Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Attachment Size
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Uploaded By
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Action
                                    </th>

                                </tr>

                                </thead>
                                <tbody>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                                    v-for="(attach, index) in loan.attachments" :key="index">
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{index + 1}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{attach.filename}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{attach.attachment_size}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{loan.user.name}}
                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        <a :href="route('borrow.download', attach.id)" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                            <DocumentArrowDownIcon class="w-4 h-4 mr-2"/> Download
                                        </a>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-4">
                <h3 class="text-primary text-2xl font-semibold mb-6">Loan Information</h3>
                <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-2 divide-x">
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <DocumentArrowDownIcon class="w-4 h-4 mr-2"/> Pdf
                        </button>
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <ArrowUpTrayIcon class="w-4 h-4 mr-2"/> Excel
                        </button>
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <FunnelIcon class="w-4 h-4 mr-2"/> Filter
                        </button>
                    </div>
                    <div>
                        <search-filter
                            v-model="search"
                            class="mr-4 w-full max-w-md mb-3">
                        </search-filter>
                    </div>
                </div>
            <div class="bg-white relative overflow-x-auto mt-4">

                <table class="w-full text-sm whitespace-nowrap">
                    <thead class="sticky top-0">
                    <tr>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            S/N
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            File Name
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Attachment Size
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Uploaded By
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Action
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                    <td colspan="10" class="py-4 px-4 text-sm text-left border">
                        <div class="flex flex-col items-center py-7">
                            <img src="/images/empty.svg" class="w-32 h-32"/>
                            <div class="mb-1 pt-6 text-base font-semibold text-heading">No data found</div>
                            <p class="text-[13px]">Sorry we couldn’t found any data</p>
                        </div>
                    </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            </div>

            <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-4">
                <h3 class="text-primary text-2xl font-semibold mb-6">Repayment History</h3>
                <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-2 divide-x">
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <DocumentArrowDownIcon class="w-4 h-4 mr-2"/> Pdf
                        </button>
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <ArrowUpTrayIcon class="w-4 h-4 mr-2"/> Excel
                        </button>
                        <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <FunnelIcon class="w-4 h-4 mr-2"/> Filter
                        </button>
                    </div>
                    <div>
                        <search-filter
                            v-model="search"
                            class="mr-4 w-full max-w-md mb-3">
                        </search-filter>
                    </div>
                </div>
                <div class="bg-white relative overflow-x-auto mt-4">

                    <table class="w-full text-sm whitespace-nowrap">
                        <thead class="sticky top-0">
                        <tr>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                S/N
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                File Name
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Attachment Size
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Uploaded By
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Action
                            </th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                            <td colspan="10" class="py-4 px-4 text-sm text-left border">
                                <div class="flex flex-col items-center py-7">
                                    <img src="/images/empty.svg" class="w-32 h-32"/>
                                    <div class="mb-1 pt-6 text-base font-semibold text-heading">No data found</div>
                                    <p class="text-[13px]">Sorry we couldn’t found any data</p>
                                </div>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</AppLayout>
</template>


<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {ArrowLeftIcon, ArrowUpTrayIcon, DocumentArrowDownIcon, FunnelIcon} from "@heroicons/vue/24/outline/index.js";
import moment from "moment";
import SearchFilter from "@/Shared/SearchFilter.vue";

const props = defineProps({
    loan:Object
})

function uppercase(str){
    return str.charAt(0).toUpperCase() + str.slice(1);
}


function formatDate(dateString) {
  const date = moment(dateString);
  return date.format("DD-MM-YYYY");
}
</script>

<style scoped>

</style>
