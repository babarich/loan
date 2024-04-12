<template>
    <AppLayout>
        <div class="flex justify-between mb-6 mt-4">
            <div class="mt-2">
                <h3 class="text-xl text-primary text-semibold">Loan payments</h3>
            </div>
            <div>


            </div>
        </div>

        <div class="rounded bg-white p-5 shadow md:p-8 w-full">
            <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-2 divide-x">
                    <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                        <DocumentArrowDownIcon class="w-4 h-4 mr-2"/> Pdf
                    </button>
                    <button class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded"
                            @click="exportCSV($event)" >
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
            <ConfirmPopup></ConfirmPopup>

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
                        <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('description')">Borrower</TableHeaderCell>
                        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('name')">  Amount</TableHeaderCell>
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
                    <tr v-for="(payment,index) in payments.data" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{payment.date}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{payment.reference}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{payment.name}}</td>
                        <td class="py-4 px-4 text-sm text-left border"> {{
                                formatCurrency(payment.amount)
                            }}</td>

                        <td class="py-4 px-4 text-sm text-left border"> {{
                                payment.type
                            }}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{payment.user}}</td>
                        <td class="py-4 px-4 text-sm text-left border"></td>

                    </tr>
                    <tr v-if="payments.data.length === 0">
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
            <pagination class="mt-6" :data="payments" :links="payments.links" @getPage="getChanges"/>
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
    payments:Object, errors:Object
});
const confirm = useConfirm();
const toast = useToast();
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');


const dt = ref();

const exportCSV = () => {
    dt.value.exportCSV();
};

function getChanges(page){
    Inertia.get(
        route('payment.index'),
        {per_page:page},
        {
            preserveState:true,
            replace:true
        }
    )
}
function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}

function confirm2(){
    confirm.require({
        target: event.currentTarget,
        message: 'Do you want to delete this record?',
        icon: 'pi pi-info-circle',
        rejectClass: 'p-button-secondary p-button-outlined p-button-sm',
        acceptClass: 'p-button-danger p-button-sm',
        rejectLabel: 'Cancel',
        acceptLabel: 'Delete',
        accept: () => {
            toast.add({ severity: 'info', summary: 'Confirmed', detail: 'Record deleted', life: 3000 });
        },
        reject: () => {
            toast.add({ severity: 'error', summary: 'Rejected', detail: 'You have rejected', life: 3000 });
        }
    });
};

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
        route("payment.index"),
        {sort_field:sortField.value,sort_direction:sortDirection.value},{
            preserveState:true,
            replace:true
        }
    )

}


</script>
