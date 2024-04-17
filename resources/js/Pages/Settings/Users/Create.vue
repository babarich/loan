<template>
    <AppLayout>


        <div class="h-full p-5 md:p-8">
            <div class="flex border-b border-dashed border-border-base pb-5 md:pb-7">
                <h1 class="text-lg font-semibold text-heading">Create User  </h1>
            </div>
            <form @submit.prevent="onSubmit">
                <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                    <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                        <h4 class="text-base font-semibold text-body-dark mb-2">Basic Info</h4>
                        <p class="text-sm text-body">Add some basic info about your user </p>
                    </div>
                    <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Full Name<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.name}" type="text" v-model="form.name"/>
                            <p v-if="errors.name">{{errors.name}}</p>
                        </div>
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Email<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.email}" type="text" v-model="form.email"/>
                            <p v-if="errors.email">{{errors.email}}</p>
                        </div>
                        <div class="mb-5">
                            <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Default Password<span
                                class="ml-0.5 text-red-500">*</span></label>
                            <CustomInput :class="{'border-red-500' : errors.password}" type="text" v-model="form.password"/>
                            <p v-if="errors.password">{{errors.password}}</p>
                        </div>
                        <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                                 for="slug">Role</label>
                            <CustomInput
                                required
                                type="select"
                                :select-options="roleOptions"
                                v-model="form.role"

                            />
                            <p v-if="errors.role">{{errors.role}}</p>
                        </div>
                        <div class="mb-3 mt-8 text-end">
                            <NButtonLoading :loading="loading" class="mt-3 w-full inline-flex justify-center
                    shadow-sm px-4 py-2  text-base font-medium text-gray-700
                     focus:outline-none focus:ring-2 focus:ring-offset-2
                      focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Submit
                            </NButtonLoading>
                        </div>
                    </div>
                </div>



            </form>
        </div>
    </AppLayout>
</template>


<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import FileUpload from "primevue/fileupload";
import {computed, ref} from 'vue';
import {useForm} from "@inertiajs/vue3";
import CustomInput from "@/Shared/CustomInput.vue";
import NButtonLoading from "@/Shared/NButtonLoading.vue";


const loading = ref(false);



const form = useForm({
    name: null,
    email:null,
    role:null,
    password:null,

});


const props = defineProps({
    errors:Object, roles:Object
});


const roleOptions = computed(() =>
    props.roles.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);

function onSubmit(){
    loading.value = true
    form.post(route('user.store'),{
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
