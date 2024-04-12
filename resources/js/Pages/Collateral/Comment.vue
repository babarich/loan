<template>
    <AppLayout>
        <div class="flex justify-between mb-6 mt-4">
            <div class="mt-2">
                <h3 class="text-xl text-primary text-semibold">Loan Comments</h3>
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
            <ConfirmPopup></ConfirmPopup>

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
                                         @click="sortTransaction('name')">  Date </TableHeaderCell>
                        <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('description')"> Loan Reference</TableHeaderCell>
                        <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('description')">Loan  Borrower</TableHeaderCell>
                        <TableHeaderCell field="name" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('name')">  Description</TableHeaderCell>
                        <TableHeaderCell field="description" :sort-field="sortField" :sort-direction="sortDirection"
                                         @click="sortTransaction('description')"> Commented By</TableHeaderCell>

                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(comment,index) in comments.data" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{comment.date}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{comment.reference}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{comment.borrower}}</td>
                        <td class="py-4 px-4 text-sm text-left border"> {{
                                comment.description
                            }}</td>


                        <td class="py-4 px-4 text-sm text-left border">{{comment.user}}</td>

                    </tr>
                    <tr v-if="comments.data.length === 0">
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
            <pagination class="mt-6" :data="comments" :links="comments.links" @getPage="getChanges"/>
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
    comments:Object, errors:Object
});
const confirm = useConfirm();
const toast = useToast();
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');




function getChanges(page){
    Inertia.get(
        route('collateral.showComment'),
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
        route("collateral.showComment"),
        {sort_field:sortField.value,sort_direction:sortDirection.value},{
            preserveState:true,
            replace:true
        }
    )

}


</script>
