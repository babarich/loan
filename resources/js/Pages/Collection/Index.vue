<template>
    <AppLayout>
        <div class="flex justify-between mb-6 mt-4">
            <div class="mt-2">
                <h3 class="text-xl text-primary text-semibold">Daily Collection Sheet</h3>
            </div>
            <div>


            </div>
        </div>


        <div class="m-2 max-w-screen-md justify-content-center text-center">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-lg">
                <h2 class="text-stone-700 text-xl font-bold">Apply filters</h2>
                <p class="mt-1 text-sm">Use filters to further refine search</p>

                    <div class="mt-8  gap-6">
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Borrowers Group<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput
                                required
                                type="select"
                                :select-options="groupOptions"
                                v-model="form.groupId"

                            />
                            <p v-if="errors.groupId">{{errors.groupId}}</p>
                        </div>
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Start Date<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.startDate}" type="date" v-model="form.startDate" />
                            <p v-if="errors.startDate">{{errors.startDate}}</p>
                        </div>
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">End Date<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.endDAte}" type="date" v-model="form.endDate"/>
                            <p v-if="errors.endDAte">{{errors.endDAte}}</p>
                        </div>
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Staff<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput
                                required
                                type="select"
                                :select-options="staffOptions"
                                v-model="form.staffId"

                            />
                            <p v-if="errors.staffId">{{errors.staffId}}</p>
                        </div>
                    </div>

                    <div class="mt-6 grid w-full grid-cols-2 justify-end space-x-4 md:flex">
                        <button type="button" class="active:scale-95 rounded-lg bg-gray-200 px-8 py-2 font-medium text-gray-600 outline-none focus:ring hover:opacity-90">Reset</button>
                        <button type="button" @click='searchData' class="active:scale-95 rounded-lg bg-primary px-8 py-2 font-medium text-white outline-none focus:ring hover:opacity-90">Search</button>
                    </div>


            </div>
        </div>




        <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-8">
   <h3 class="text-lg text-primary mb-3">Total Collections</h3>
            <div class="bg-white overflow-x-auto">
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
                            Total Loans Collected
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Total Amount
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Total Collected By
                        </th>

                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr  class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                           1
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{collections.total_id}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{formatCurrency(collections.total_amount)}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{collections.total_users}}</td>

                        <td class="py-4 px-4 text-sm text-left border">
                            <div class="flex justify-between flex-col md:flex-row items-center">
                                <div class="flex items-center space-x-2 divide-x">
                                    <a  class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                        <i class="pi pi-download mr-2 text-white"></i>
                                        Export Data
                                    </a>

                                </div>



                            </div>
                        </td>
                    </tr>
                    <tr v-if="collections.length === 0">
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
    </AppLayout>
</template>

<script setup>
import {ref, onMounted, computed} from 'vue';
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
import CustomInput from "@/Shared/CustomInput.vue";
import {useForm} from "@inertiajs/vue3";
import NButtonLoading from "@/Shared/NButtonLoading.vue";

const props = defineProps({
    groups:Object, staffs:Object, errors:Object, collections:Object
});
const confirm = useConfirm();
const toast = useToast();
const search = ref('');
const sortField = ref('updated_at');
const sortDirection = ref('desc');

const loading = ref(false)

const staffOptions = computed(() =>
    props.staffs.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);


const groupOptions = computed(() =>
    props.groups.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);

function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}


const form = useForm({
    groupId:null,
    staffId:null,
    startDate:null,
    endDate:null,

})


function searchData(){

    Inertia.get(
        route('payment.collection'),
        {filterCollection:form},
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




</script>
