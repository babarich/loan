<template>
    <AppLayout>
        <div class="flex justify-between mb-6 mt-4">
            <div class="mt-2">
                <h3 class="text-xl text-primary text-semibold">Borrowers</h3>
            </div>
            <div>
                <NButton :href="route('borrow.create')" class="text-white">
                    <PlusCircleIcon class="w-4 h-4  text-white mr-2"/>  Add Borrower
                </NButton>

            </div>
        </div>

        <div class="rounded bg-white p-5 shadow md:p-8 w-full">
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
            <Toast />
            <ConfirmPopup group="positionDialog"></ConfirmPopup>
        <div class="bg-white overflow-x-auto">
            <table class="w-full text-sm whitespace-nowrap">
                <thead class="sticky top-0">
                 <tr>
                     <th
                         scope="col"
                         class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                         S/N
                     </th>
                     <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('name')"> Full Name</TableHeaderCell>
                     <TableHeaderCell field="reference" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('reference')"> Reference</TableHeaderCell>
                     <TableHeaderCell field="email" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('email')"> Email</TableHeaderCell>
                     <TableHeaderCell field="mobile" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('mobile')"> Mobile</TableHeaderCell>
                     <TableHeaderCell field="business" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('business')"> Business</TableHeaderCell>
                     <TableHeaderCell field="balance" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('balance')">Open Loan Balance</TableHeaderCell>
                     <TableHeaderCell field="total_paid" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('total_paid')"> Total Paid</TableHeaderCell>
                     <TableHeaderCell field="status" :sort-field="sortField" :sort-direction="sortDirection"
                                      @click="sortTransaction('status')"> Status</TableHeaderCell>
                     <th
                         scope="col"
                         class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                         Action
                     </th>
                 </tr>
                </thead>
                <tbody>
                <tr v-for="(customer,index) in customers.data" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                    <td class="py-4 px-4 text-sm text-left border">
                        {{index + 1}}
                    </td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.name}}</td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.reference}}</td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.email}}</td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.mobile}}</td>
                    <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.business}}</td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.balance}}</td>
                    <td class="py-4 px-4 text-sm text-left border">{{customer.total_paid}}</td>
                    <td class="py-4 px-4 text-sm text-left border">
                        <span class="bg-yellow-500 text-white p-2 rounded-md text-xs" v-if="customer.status === 'pending'">
                            Pending
                        </span>
                        <span class="bg-emerald-500 text-white p-2 rounded-md text-xs" v-else>
                            Approved
                        </span>
                    </td>
                    <td class="py-4 px-4 text-sm text-left border">
                     <div class="flex justify-between flex-col md:flex-row items-center">
                         <div class="flex items-center space-x-2 divide-x">
                             <a :href="route('borrow.show', customer.id)" class="px-4 text-sm flex text-gray-100 bg-emerald-600 p-2 rounded">
                                 <i class="pi pi-eye text-white"></i>
                             </a>
                             <a :href="route('borrow.edit', customer.id)" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                 <i class="pi pi-pencil text-white"></i>
                             </a>

                             <button @click.prevent="confirmDelete(customer.id)"  class="px-4 text-sm flex text-gray-100 bg-red-500 p-2 rounded">
                                 <i class="pi pi-trash text-white"></i>
                             </button>
                         </div>



                     </div>
                    </td>
                </tr>
                <tr v-if="customers.data.length === 0">
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
            <pagination class="mt-6" :data="customers" :links="customers.links" @getPage="getChanges"/>
    </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import {Inertia} from "@inertiajs/inertia";
import DataTable from "primevue/datatable";
import AppLayout from "@/Layouts/AppLayout.vue";
import NButton from "@/Shared/NButton.vue";
import SearchFilter from "@/Shared/SearchFilter.vue";
import "primeicons/primeicons.css"
import TableHeaderCell from "@/Shared/TableHeaderCell.vue";
import {DocumentArrowDownIcon,ArrowUpTrayIcon,FunnelIcon,PlusCircleIcon} from '@heroicons/vue/24/outline'
import Pagination from "@/Shared/Pagination.vue";
import { useConfirm } from "primevue/useconfirm";
import { useToast } from "primevue/usetoast";

const props = defineProps({
   customers:Object, errors:Object
});
const confirm = useConfirm();
const toast = useToast();
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');




function getChanges(page){
    Inertia.get(
        route('borrow.index'),
        {per_page:page},
        {
            preserveState:true,
            replace:true
        }
    )
}


function confirmDelete(id){
    confirm.require({
        group:'positionDialog',
        message: 'Do you want to delete this record?',
        icon: 'pi pi-exclamation-triangle',
        position:'top',
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
}

function sortTransactions(field){
    if (field === sortField.value){
        if (sortDirection.value === 'desc'){
            sortDirection.value = 'asc';
        }else {
            sortDirection.value = 'desc'
        }
    }else {
        sortField.value = field;
        sortDirection.value = 'asc'
    }

    Inertia.get(
        route("borrow.index"),
        {sort_field:sortField.value,sort_direction:sortDirection.value},{
            preserveState:true,
            replace:true
        }
    )

}


</script>
