<template>
    <AppLayout>


    <div class="h-full p-5 md:p-8">
        <div class="flex border-b border-dashed border-border-base pb-5 md:pb-7">
            <h1 class="text-lg font-semibold text-heading">Create Loan </h1>
        </div>
        <form @submit.prevent="onSubmit">
            <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                    <h4 class="text-base font-semibold text-body-dark mb-2">Basic Info</h4>
                    <p class="text-sm text-body">Add some basic info about your loan</p>
                </div>
                <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">Loan Product<span
                            class="ml-0.5 text-red-500">*</span></label>
                        <CustomInput
                            required
                            type="select"
                            :select-options="productOptions"
                            v-model="form.product"

                        />
                        <p v-if="errors.product">{{errors.product}}</p>
                                 </div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Borrower Name <span
                        class="ml-0.5 text-red-500">*</span></label>
                        <CustomInput
                            required
                            type="select"
                            :select-options="borrowOptions"
                            v-model="form.borrower"

                        />
                        <p v-if="errors.borrower">{{errors.borrower}}</p>
                    </div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Disbursement Method</label>
                        <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="form.payment" :class="{'border-red-500' : errors.payment}">
                            <option value="">select..</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                            <option value="bank">Bank Transfer</option>
                            <option value="mobile">Mobile Money</option>
                        </select>
                        <p v-if="errors.payment">{{errors.payment}}</p>
                    </div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Loan Principal Amount</label>
                        <InputNumber class="w-full border border-gray-300 placeholder-gray-600 text-gray-900" v-model="form.principle" inputId="integeronly" />
                        <p v-if="errors.principle">{{errors.principle}}</p>
                    </div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Loan Release Date</label>
                        <Calendar class="w-full border border-gray-300 placeholder-gray-600 text-gray-900" v-model="form.release_date" showIcon iconDisplay="input" />
                        <p v-if="errors.release_date">{{errors.release_date}}</p>
                    </div>

                </div>
            </div>

            <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                </div>
                <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Interest Method</label>
                        <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="form.interest" :class="{'border-red-500' : errors.interest}">
                            <option value="">select..</option>
                            <option value="flat">Flat Rate</option>
                            <option value="reducing">Reducing Interest</option>
                            <option value="interest">Interest Only</option>
                            <option value="compound">Compound Interest</option>
                        </select>
                        <p v-if="errors.interest">{{errors.interest}}</p>
                    </div>
                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug">Interest Type</label>
                        <div class="flex items-center flex-col md:flex-row">
                            <div class="flex mb-5 mr-5">
                                <input type="radio"
                                       class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300" v-model="form.interest_type"
                                       :checked="form.interest_type === 'percent'" value="percent" @change="toggleInterest"/>
                                <label  class="ml-3 block text-sm font-medium text-gray-700">I want interest in percentage</label>
                            </div>
                            <div class="flex mb-5">
                                <input type="radio"
                                       class="focus:ring-indigo-500 h-5 w-5 text-indigo-600 border-gray-300" v-model="form.interest_type"
                                :checked="form.interest_type === 'amount'" value="amount" @change="toggleInterest"/>
                                <label  class="ml-3 block text-sm font-medium text-gray-700">I want interest be in fixed amount</label>
                            </div>
                        </div>

                        <p v-if="errors.birth">{{errors.birth}}</p>
                    </div>
                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug" v-if="form.interest_type === 'amount'">Loan Interest Amount</label>
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug"  v-if="form.interest_type === 'percent'">Loan Interest Percentage</label>
                        <div class="flex items-center justify-between flex-col md:flex-row">
                            <div class="w-full mr-5">
                                <InputNumber class="w-full border border-gray-300 placeholder-gray-600 text-gray-900"
                                             v-model="form.interest_amount" inputId="integeronly"  v-if="form.interest_type === 'amount'"/>
                                <CustomInput type="number" v-model="form.percent"   :class="{'border-red-500' : errors.percent}" v-if="form.interest_type === 'percent'"/>
                            </div>
                            <div class="w-full">
                                <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="form.interest_method" :class="{'border-red-500' : errors.interest_method}">
                                    <option value="">select..</option>
                                    <option value="day">Per Day</option>
                                    <option value="week">Per Week</option>
                                    <option value="month">Per Month</option>
                                    <option value="year">Per Year</option>
                                </select>
                            </div>
                        </div>
                        <p v-if="errors.interest_method">{{errors.interest_method}}</p>
                    </div>

                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug">Loan Duration </label>
                        <div class="flex items-center justify-between flex-col md:flex-row">
                            <div class="w-full mr-5">
                                <CustomInput type="number" v-model="form.loan_duration"/>
                            </div>
                            <div class="w-full">
                                <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="form.duration_type" :class="{'border-red-500' : errors.duration_type}">
                                    <option value="">select..</option>
                                    <option value="day">Days</option>
                                    <option value="week">Weeks</option>
                                    <option value="month">Months</option>
                                    <option value="year">Years</option>
                                </select>
                            </div>
                        </div>
                        <p v-if="errors.duration_type">{{errors.duration_type}}</p>
                    </div>
                </div>
            </div>


            <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                </div>
                <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug">Repayment Cycle </label>
                        <div class="flex items-center justify-between flex-col md:flex-row">
                            <div class="w-full mr-5">
                                <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="form.payment_cycle" :class="{'border-red-500' : errors.payment_cycle}">
                                    <option value="">select..</option>
                                    <option value="day">daily</option>
                                    <option value="week">weekly</option>
                                    <option value="month">monthly</option>
                                </select>
                            </div>
                            <div class="w-full">
                                <CustomInput type="number"  v-model="form.number_payments"/>
                            </div>

                        </div>
                        <p v-if="errors.payment_cycle">{{errors.payment_cycle}}</p>
                    </div>

                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="slug">Select Guarantor </label>
                        <CustomInput
                            required
                            type="select"
                            :select-options="guarantorOptions"
                            v-model="form.guarantor"

                        />
                        <p v-if="errors.guarantor">{{errors.guarantor}}</p>
                    </div>

                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Comments</label>
                        <CustomInput type="textarea" v-model="form.description" :class="{'border-red-500' : errors.description}"/>
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
import {ref,computed} from 'vue';
import {useForm} from "@inertiajs/vue3";
import CustomInput from "@/Shared/CustomInput.vue";
import NButtonLoading from "@/Shared/NButtonLoading.vue";
import InputNumber from 'primevue/inputnumber';
import Calendar from 'primevue/calendar';
import RadioButton from 'primevue/radiobutton';


const loading = ref(false);

function onImageChoose(ev) {
    const file = ev.target.files[0];

    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        form.image = reader.result;

        // The field to display here
        form.image_url = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
}


function toggleInterest(){
    switch (form.interest_type) {
        case 'percent':
            form.interest_type= 'percent';
            break;
        case 'amount':
            form.interest_type= 'amount';
            break;
        default:
            form.interest_type= 'amount';
            break;
    }
}

const form = useForm({
    release_date: null,
    product: null,
    principle: null,
    interest:null,
    interest_type:'amount',
    percent:null,
    interest_amount:null,
    interest_method:null,
    loan_duration:null,
    description:null,
    duration_type:null,
    payment_cycle:null,
    number_payments:null,
    guarantor:null,
    total_interest:null,
    payment: null,
    borrower:null
});


const props = defineProps({
   errors:Object, borrowers:Object, guarantors:Object, products:Object
});

const borrowOptions = computed(() =>
    props.borrowers.map((c) => ({
        key: c.id,
        text: `${c.first_name}  ${c.last_name}`,
        value: c.id,
    }))
);


const guarantorOptions = computed(() =>
    props.guarantors.map((c) => ({
        key: c.id,
        text: `${c.first_name}  ${c.last_name}`,
        value: c.id,
    }))
);


const productOptions = computed(() =>
    props.products.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);

const onSelect = (event) => {
    form.file= event.files;
};

function onSubmit(){
    loading.value = true
    form.post(route('loan.store'),{
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
