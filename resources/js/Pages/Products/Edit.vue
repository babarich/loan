<template>
    <AppLayout>


        <div class="h-full p-5 md:p-8">
            <div class="flex flex-col md:flex-row items-center justify-between border-b border-dashed border-border-base border-gray-300 pb-5 md:pb-7">
                    <div>
                        <h1 class="text-lg font-semibold text-heading">Edit  Loan Product </h1>
                    </div>
                    <div>
                        <a :href="route('group.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                            <ArrowLeftIcon class="w-4 h-4 mr-2"/>  Back
                        </a>
                    </div>

            </div>
            <form @submit.prevent="onUpdate">
                <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                    <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                        <h4 class="text-base font-semibold text-body-dark mb-2">Basic Info</h4>
                        <p class="text-sm text-body">Edit some basic info about your loan product</p>
                    </div>
                    <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Product Name<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.name}" type="text" v-model="form.name"/>
                            <p v-if="errors.name">{{errors.name}}</p>
                        </div>
                        <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                                 for="slug">Description</label>
                            <CustomInput type="textarea"  rows="3" v-model="form.description" :class="{'border-red-500' : errors.description}" />
                            <p v-if="errors.description">{{errors.description}}</p>
                        </div>



                    </div>
                </div>


                <div class="sticky bottom-0 -mx-5 bg-gray-100/10 py-3 px-5 backdrop-blur text-end md:py-5 lg:-mx-8 lg:px-8 z-0">
                    <div class="mb-5 text-end">
                        <NButtonLoading :loading="loading" class="mt-3 w-full inline-flex justify-center
                    shadow-sm px-4 py-2  text-base font-medium text-gray-700
                     focus:outline-none focus:ring-2 focus:ring-offset-2
                      focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Submit
                        </NButtonLoading>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>


<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import FileUpload from "primevue/fileupload";
import {ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import CustomInput from "@/Shared/CustomInput.vue";
import NButtonLoading from "@/Shared/NButtonLoading.vue";
import {ArrowLeftIcon} from "@heroicons/vue/24/outline";
import moment from "moment";


const loading = ref(false);


const props = defineProps({
    errors:Object,product:Object
});

const form = useForm({
    name: props.product.name,
    description:props.product.description,
});



function onUpdate(){
    loading.value = true
    form.post(route('product.update', props.product.id),{
        onSuccess:()=>{
            loading.value = false
        },
        onError:()=>{
            loading.value = false
        }
    })
}

</script>

<style scoped>
.custom-file-upload .p-fileupload-buttons {
    display: none;
}
</style>
