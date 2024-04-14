<template>
<AppLayout>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>

        </div>
        <div class="flex justify-between">

            <a   class="px-4 text-sm flex text-gray-100 bg-boxdark p-2 rounded mr-4">
                <i class="pi pi-cloud-download w-4 h-4 mr-2"></i>  Download Profile
            </a>

            <a :href="route('borrow.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                <ArrowLeftIcon class="w-4 h-4 mr-2"/>  Back
            </a>
        </div>
    </div>
    <div class="bg-gray-100">
        <div class="p-4 mx-auto py-8">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-4">
                        <div class="m-10 max-w-sm">
                                <div class="relative mx-auto w-52 rounded-full">
                                    <img :src="customer.filename" class="object-cover h-52 bg-gray-300 rounded-md mb-4 shrink-0" :alt="customer.first_name" />
                                </div>
                                <h1 class="my-1 text-center text-xl font-bold leading-8 text-gray-900">{{uppercase(customer.title)}}. {{uppercase(customer.first_name)}} {{uppercase(customer.last_name)}}</h1>
                                <h3 class="font-lg text-semibold text-center leading-6 text-gray-600">{{customer.business_name}}, {{customer.working_status}}</h3>
                                <ul class="mt-3 divide-y rounded bg-gray-100 py-2 px-3 text-gray-600 shadow-sm hover:text-gray-700 hover:shadow">
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Age</span>
                                        <span class="ml-auto">{{customer.age}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Gender</span>
                                        <span class="ml-auto">{{uppercase(customer.gender)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Joined On</span>
                                        <span class="ml-auto">{{formatDate(customer.created_at)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Loan Officer</span>
                                        <span class="ml-auto">{{customer.user.name}}</span>
                                    </li>
                                </ul>

                        </div>


                    </div>
                </div>
                <div class="w-full md:w-2/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Borrower Information</h2>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Address</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{customer.address}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">City</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{customer.city}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Mobile</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{customer.mobile}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Email</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{customer.email}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Description</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{customer.description}}</span>
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
                                    v-for="(attach, index) in customer.attachments" :key="index">
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
                                        {{customer.user.name}}
                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        <div class="flex justify-between flex-col md:flex-row items-center">
                                            <div class="flex items-center space-x-2 divide-x">
                                                <a :href="route('borrow.download', attach.id)" class="text-sm flex text-gray-100 bg-primary p-2 rounded">
                                                    <CloudArrowDownIcon class="w-4 h-4 mr-2"/> Download
                                                </a>
                                            </div>
                                        </div>

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
                        <TableHeaderCell field="reference" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('reference')"> Reference</TableHeaderCell>



                        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('principal')"> Principal </TableHeaderCell>

                        <TableHeaderCell field="principal" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('interest')"> Total Interest</TableHeaderCell>

                        <TableHeaderCell field="principal" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('interest')">  Interest</TableHeaderCell>

                        <TableHeaderCell field="interest" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('interest_tye')"> Interest Type</TableHeaderCell>

                        <TableHeaderCell field="balance" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('due')">Due Amount</TableHeaderCell>

                        <TableHeaderCell field="due" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('total_paid')"> Total Paid</TableHeaderCell>

                        <TableHeaderCell field="due" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('last_payment')"> Last Payment </TableHeaderCell>

                        <TableHeaderCell field="due" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('last_payment')"> Status </TableHeaderCell>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(loan,index) in customer.loans" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>

                        <td class="py-4 px-4 text-sm text-left border">{{loan.reference}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{loan.principle_amount}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{loan.total_interest}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{loan.interest_percentage ? loan.interest_percentage + ' ' + '%' : loan.interest_amount}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{'per'+' ' + loan.interest_duration}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{loan.loanpayment.due_amount}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{loan.loanpayment.paid_amount}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{loan.loanpayment.latest_payment}}</td>
                        <td class="py-4 px-4 text-sm text-left border">
                        <span class="bg-yellow-500 text-white p-2 rounded-md text-xs" v-if="loan.status === 'pending'">
                            Pending
                        </span>
                            <span class="bg-emerald-500 text-white p-2 rounded-md text-xs" v-else>
                            Approved
                        </span>
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">
                            <div class="flex justify-between flex-col md:flex-row items-center">
                                <div class="flex items-center space-x-2 divide-x">
                                    <a :href="route('loan.show', loan.id)" class="px-4 text-sm flex text-gray-100 bg-emerald-600 p-2 rounded">
                                        <i class="pi pi-eye text-white mr-2"></i> View
                                    </a>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr v-if="customer.loans.length === 0">
                        <td colspan="12" class="py-4 px-4 text-sm text-left border">
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
                <div class="bg-white overflow-x-auto">
                    <table class="w-full text-sm whitespace-nowrap" ref="dt">
                        <thead class="sticky top-0">
                        <tr>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                S/N
                            </th>
                            <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                             @click="sortTransaction('description')">Collection  Date</TableHeaderCell>
                            <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                             @click="sortTransaction('name')">  Loan Reference </TableHeaderCell>
                            <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                             @click="sortTransaction('name')">  Amount Paid</TableHeaderCell>
                            <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                             @click="sortTransaction('description')"> Payment Type</TableHeaderCell>
                            <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                             @click="sortTransaction('description')"> Collected By</TableHeaderCell>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Action
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(payment,index) in customer.payments" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                            <td class="py-4 px-4 text-sm text-left border">
                                {{index + 1}}
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">{{payment.payment_date}}</td>
                            <td class="py-4 px-4 text-sm text-left border">{{payment.loan.reference}}</td>
                            <td class="py-4 px-4 text-sm text-left border"> {{
                                    formatCurrency(payment.amount)
                                }}</td>

                            <td class="py-4 px-4 text-sm text-left border"> {{
                                    payment.type
                                }}</td>
                            <td class="py-4 px-4 text-sm text-left border">{{payment.user.name}}</td>
                            <td class="py-4 px-4 text-sm text-left border"></td>

                        </tr>
                        <tr v-if="customer.payments.length === 0">
                            <td colspan="10" class="py-4 px-4 text-sm text-left border">
                                <div class="flex flex-col items-center py-7">
                                    <img  src="/images/empty.svg" class="w-32 h-32"/>
                                    <div class="mb-1 pt-6 text-base font-semibold text-heading">No data found</div>
                                    <p class="text-[13px]">Sorry we couldn’t found any data</p>
                                </div>
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
<!--                <pagination class="mt-6" :data="customer.payments" :links="customer.payments.links" @getPage="getChanges"/>-->
            </div>
        </div>
    </div>
</AppLayout>
</template>


<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {
    ArrowLeftIcon,
    ArrowUpTrayIcon,
    CloudArrowDownIcon,
    DocumentArrowDownIcon,
    FunnelIcon, PlusIcon
} from "@heroicons/vue/24/outline/index.js";
import moment from "moment";
import SearchFilter from "@/Shared/SearchFilter.vue";
import Pagination from "@/Shared/Pagination.vue";
import TableHeaderCell from "@/Shared/TableHeaderCell.vue";

const props = defineProps({
    customer:Object
})

function uppercase(str){
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}

function formatDate(dateString) {
  const date = moment(dateString);
  return date.format("DD-MM-YYYY");
}
</script>

<style scoped>

</style>
