<template>
<AppLayout>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>

        </div>
        <div class="flex justify-between">

            <button  @click="relation = true" class="px-4 text-sm flex text-gray-100 bg-boxdark p-2 rounded mr-4">
                <i class="pi pi-plus w-4 h-4 mr-2"></i>  Add Relation Officer
            </button>

            <a :href="route('group.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                <ArrowLeftIcon class="w-4 h-4 mr-2"/>  Back
            </a>
        </div>
    </div>
    <Dialog v-model:visible="relation" modal header="Add Relation Officer" :position="top" style="width:50%">
        <form @submit.prevent="submitRelation">
            <div class="mb-5">
                <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                       for="slug">Select User</label>
                <CustomInput
                    required
                    type="select"
                    :select-options="userOptions"
                    v-model="form.user_id"

                />
                <p v-if="errors.user_id">{{errors.user_id}}</p>
            </div>


            <div class="flex flex-col md:flex-row justify-between mt-8">
                <div>

                </div>

                <div>
                    <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="relation = false">Cancel</button>
                    <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                </div>

            </div>
        </form>
    </Dialog>
    <div class="bg-gray-100">
        <div class="p-3 mx-auto py-8">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="w-full md:w-1/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="m-10 max-w-sm">
                                <div class="relative mx-auto w-52 rounded-full">
                                    <div
                                        class="relative inline-flex items-center justify-center w-32 h-32 overflow-hidden bg-primary  rounded-full">
                                <span
                                    class="font-medium text-white text-3xl">{{ getInitials(group.name) }}</span>
                                    </div>
                                    <h1 class="py-2   text-xl font-bold leading-8 text-gray-900">Name : {{uppercase(group.name)}}</h1>
                                </div>



                        </div>


                    </div>
                </div>
                <div class="w-full md:w-2/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Borrower Group Information</h2>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Group Created At</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{formatDate(group.created_at)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Created By</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{group.user.name}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Relation Officer</span>
                            <p>
                                <span class="text-gray-700 mr-2 flex flex-col md:flex-row">
                                    <span class="inline-flex items-center rounded-md bg-blue-50
                                     px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"
                                    v-for="(user, index) in group.officers" :key="index">{{user.user ? user.user.name : 'N/A'}}</span>



                                    <span class="inline-flex items-center rounded-md bg-blue-50
                                     px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-700/10"
                                          v-if="group.officers.length === 0" >No Officer Assigned</span>

                                </span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Description</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{group.description}}</span>
                            </p>
                        </div>


                    </div>
                </div>
            </div>
            <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-4">
                <h3 class="text-primary text-2xl font-semibold mb-6">Group Members</h3>
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
                            Reference
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Full Name
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                          Email
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Mobile
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Business
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Open Balance
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Total Paid
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Action
                        </th>

                    </tr>

                    </thead>
                    <tbody>
                    <tr v-for="(customer,index) in borrowers.data" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.reference}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.name}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.email}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.mobile}}</td>
                        <td class="py-4 px-4 text-sm text-left border text-wrap">{{customer.business}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.balance}}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{customer.total_paid}}</td>

                        <td class="py-4 px-4 text-sm text-left border">
                            <div class="flex justify-between flex-col md:flex-row items-center">
                                <div class="flex items-center space-x-2 divide-x">
                                    <a :href="route('borrow.show', customer.id)" class="px-4 text-sm flex text-gray-100 bg-emerald-600 p-2 rounded">
                                        <i class="pi pi-eye text-white"></i>
                                    </a>

                                </div>



                            </div>
                        </td>
                    </tr>
                    <tr v-if="borrowers.data.length === 0">
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
                <pagination class="mt-6" :data="borrowers" :links="borrowers.links" @getPage="getChanges"/>
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
import Pagination from "@/Shared/Pagination.vue";
import {Inertia} from "@inertiajs/inertia";
import NButtonLoading from "@/Shared/NButtonLoading.vue";
import InputNumber from "primevue/inputnumber";
import CustomInput from "@/Shared/CustomInput.vue";
import Dialog from "primevue/dialog";
import {computed, ref} from "vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    group:Object, borrowers:Object,users:Object, errors:Object
})


const relation = ref(false);


const loading = ref(false)

function uppercase(str){
    return str.charAt(0).toUpperCase() + str.slice(1);
}



const userOptions = computed(() =>
    props.users.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);

const form = useForm({
    'user_id' : null
})
function getInitials(fullName) {
    const allNames = fullName.trim().split(" ");
    const initials = allNames.reduce((acc, curr, index) => {
        if (index === 0 || index === allNames.length - 1) {
            acc = `${acc}${curr.charAt(0).toUpperCase()}`;
        }
        return acc;
    }, "");
    return initials;
}


function getChanges(page){
    Inertia.get(
        route('group.show', props.group.id),
        {per_page:page},
        {
            preserveState:true,
            replace:true
        }
    )
}
function submitRelation(){
    loading.value = true
    form.post(route('group.relation', props.group.id),{
        onSuccess:()=>{
            loading.value = false
            relation.value = false
            form.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}
function formatDate(dateString) {
  const date = moment(dateString);
  return date.format("DD-MM-YYYY");
}
</script>

<style scoped>

</style>
