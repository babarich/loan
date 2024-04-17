<template>
    <AppLayout>
        <div class="flex justify-between mb-6 mt-4">
            <div class="mt-2">
                <h3 class="text-xl text-primary text-semibold">Users Management</h3>
            </div>
            <div>
                <NButton :href="route('user.create')" class="text-white">
                    <PlusCircleIcon class="w-4 h-4  text-white mr-2"/>  Add User
                </NButton>
            </div>
        </div>

        <div class="rounded bg-white p-5 shadow md:p-8 w-full">
            <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center space-x-2 divide-x">

                </div>
                <div>
                    <search-filter
                        v-model="search"
                        class="mr-4 w-full max-w-md mb-3">
                    </search-filter>
                </div>
            </div>

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
                            Last Login
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Role
                        </th>
                        <th
                            scope="col"
                            class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,index) in users" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                        <td class="py-4 px-4 text-sm text-left border">
                            {{index + 1}}
                        </td>
                        <td class="py-4 px-4 text-sm text-left border">{{user.name}}</td>
                        <td class="py-4 px-4 text-sm text-left border"> {{
                                user.email
                            }}</td>
                        <td class="py-4 px-4 text-sm text-left border">{{user.last_login}}</td>
                        <td>
                            <span  class="inline-flex items-center rounded-md bg-red-50
                                     px-2 py-1 text-xs font-medium text-red-700 space-y-2 ring-1 ring-inset ring-red-700/10"
                                   v-for="(role,index) in user.roles" :key="index">{{role.name}}</span>

                        </td>

                        <td class="py-4 px-4 text-sm text-left border">
                            <div class="flex justify-between flex-col md:flex-row items-center">
                                <div class="flex items-center space-x-2 divide-x">
                                    <a  @click="setIsOpen(user.id)" class="px-4 text-sm flex text-gray-100 bg-emerald-600 p-2 rounded mr-4
                                     cursor-pointer">
                                        <i class="pi pi-check text-white mr-2"></i> Assign Role
                                    </a>
                                    <a @click="setIsRole(user)" class="px-4 text-sm flex text-gray-100 bg-red-600 p-2 rounded cursor-pointer">
                                        <i class="pi pi-times-circle text-white mr-2"></i> UnAssign Role
                                    </a>


                                </div>



                            </div>
                        </td>
                    </tr>
                    <tr v-if="users.length === 0">
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

                <TransitionRoot appear :show="isOpen" as="template">
                    <Dialog as="div" @close="closeIsOpen" class="relative z-50">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-y-auto">
                            <div
                                class="flex min-h-full items-center justify-center p-4 text-center"
                            >
                                <TransitionChild
                                    as="template"
                                    enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95"
                                    enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in"
                                    leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95"
                                >
                                    <DialogPanel
                                        class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                    >
                                        <DialogTitle
                                            as="h3"
                                            class="text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Assign User Role
                                        </DialogTitle>
                                        <form @submit.prevent="assignUser">
                                            <div class="mb-5 mt-4"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                                                     for="slug">Select Role</label>
                                                <CustomInput
                                                    required
                                                    type="select"
                                                    :select-options="roleOptions"
                                                    v-model="form.name"

                                                />
                                                <p v-if="errors.name">{{errors.name}}</p>
                                            </div>

                                            <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <NButtonLoading :loading="loading" class="mt-3 w-full inline-flex justify-center
                                                shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                                 focus:outline-none focus:ring-2 focus:ring-offset-2
                                                  focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                                                Submit
                                                </NButtonLoading>
                                                <button type="button"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                        @click="closeOpen" ref="cancelButtonRef">
                                                    Cancel
                                                </button>
                                            </footer>
                                        </form>




                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>


                <TransitionRoot appear :show="isRole" as="template">
                    <Dialog as="div" @close="closeIsRole" class="relative z-50">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black bg-opacity-25" />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-y-auto">
                            <div
                                class="flex min-h-full items-center justify-center p-4 text-center"
                            >
                                <TransitionChild
                                    as="template"
                                    enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95"
                                    enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in"
                                    leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95"
                                >
                                    <DialogPanel
                                        class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                    >
                                        <DialogTitle
                                            as="h3"
                                            class="text-lg font-medium leading-6 text-gray-900"
                                        >
                                            Un-Assign User Role
                                        </DialogTitle>
                                        <form @submit.prevent="assignUser">
                                            <div class="mb-5 mt-4">

                                                <div class="card flex justify-content-center">
                                                    <div class="flex flex-row gap-3">

                                                        <div v-for="role of roleUnOptions" :key="role.key" class="flex align-items-center flex-row">
                                                            <Checkbox v-model="roleFormSelected" :inputId="role.key" name="role"
                                                                      class="border border-gray-400 rounded-lg"
                                                                      :value="role.text"
                                                                      @change="handleCheckboxChange(role.text)"/>
                                                            <label :for="role.key">{{ role.text }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <footer class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="button"
                                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                                        @click="closeIsRole" ref="cancelButtonRef">
                                                    Cancel
                                                </button>
                                            </footer>
                                        </form>




                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot>
            </div>

        </div>
    </AppLayout>
</template>

<script setup>
import {ref, onMounted, computed} from 'vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import NButton from "@/Shared/NButton.vue";
import SearchFilter from "@/Shared/SearchFilter.vue";
import "primeicons/primeicons.css"
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {useForm} from "@inertiajs/vue3";
import NButtonLoading from "@/Shared/NButtonLoading.vue";
import CustomInput from "@/Shared/CustomInput.vue";
import Checkbox from 'primevue/checkbox';
import {PlusCircleIcon} from "@heroicons/vue/24/outline/index.js";
const user_id = ref('')
const isOpen = ref(false)

const isRole = ref(false)
const loading = ref(false)

const userRoles = ref([]);
function setIsOpen(user) {
    isOpen.value = true
    user_id.value = user
}

const roleFormSelected = ref([])


function closeIsOpen() {
    isOpen.value = false
    user_id.value = false
}


function setIsRole(user) {
    isRole.value = true
    user_id.value = user.id
    userRoles.value = user.roles
    const roleNames = user.roles.map(role => role.name);
    roleFormSelected.value = roleNames;
}

function closeIsRole() {
    isRole.value = false
    user_id.value = false
}


const props = defineProps({
    users:Object, errors:Object, roles:Object
});

const search = ref('');

const form = useForm({
    'name': null
})

const roleForm = useForm({
    'name': null
})

const roleUnOptions = computed(() =>
    userRoles.value.map((c) => ({
        key: c.name,
        text: `${c.name}`,
        value: c.name,
    }))
);

const roleOptions = computed(() =>
    props.roles.map((c) => ({
        key: c.name,
        text: `${c.name}`,
        value: c.name,
    }))
);
function assignUser(){
    loading.value = true
    form.post(route('user.assign', user_id.value),{
        onSuccess:()=>{
            loading.value = false
            isOpen.value = false
            form.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}






function handleCheckboxChange(text){
    const data = useForm({
        'name' : text
    })
    data.post(route('user.unassign', user_id.value),{
        onSuccess:()=>{
            isRole.value = false
            form.reset()
        },
        onError:()=>{
        }
    })
}




</script>
