<template>
<AppLayout>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>

        </div>
        <div>
            <a :href="route('product.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
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
                                    <div
                                        class="relative inline-flex items-center justify-center w-32 h-32 overflow-hidden bg-primary  rounded-full">
                                <span
                                    class="font-medium text-white text-3xl">{{ getInitials(product.name) }}</span>
                                    </div>
                                    <h1 class="py-2   text-xl font-bold leading-8 text-gray-900">{{uppercase(product.name)}}</h1>
                                </div>



                        </div>


                    </div>
                </div>
                <div class="w-full md:w-2/3 space-y-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold mb-4">Loan product Information</h2>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">product Created At</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{formatDate(product.created_at)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Created By</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{product.user.name}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Description</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{product.description}}</span>
                            </p>
                        </div>


                    </div>
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
    product:Object
})

function uppercase(str){
    return str.charAt(0).toUpperCase() + str.slice(1);
}


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


function formatDate(dateString) {
  const date = moment(dateString);
  return date.format("DD-MM-YYYY");
}
</script>

<style scoped>

</style>
