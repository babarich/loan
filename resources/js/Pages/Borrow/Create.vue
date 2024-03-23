<template>
    <AppLayout>


    <div class="h-full p-5 md:p-8">
        <div class="flex border-b border-dashed border-border-base pb-5 md:pb-7">
            <h1 class="text-lg font-semibold text-heading">Create Borrower </h1>
        </div>
        <form novalidate="">
            <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                    <h4 class="text-base font-semibold text-body-dark mb-2">Basic Info</h4>
                    <p class="text-sm text-body">Add some basic info about your borrower</p>
                </div>
                <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                    <div class="mb-5">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3" for="name">First Name<span
                            class="ml-0.5 text-red-500">*</span></label>
                              <CustomInput type="text" />
                                 </div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Last Name</label>
                    <CustomInput type="text" />
                    </div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Gender</label>
                        <CustomInput type="select">
                            <option value="">select..</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </CustomInput>

                    </div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Title</label><select id="slug" name="slug" type="text"
                                                                                    class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12">
                        <option value="">select..</option>
                        <option value="mr">Mr</option>
                        <option value="mrs">Mrs.</option>
                        <option value="miss">Miss.</option>
                        <option value="ms">Ms.</option>
                        <option value="doc">Doc.</option>
                        <option value="rev">Rev.</option>
                        <option value="prof">Prof.</option>
                    </select>
                    </div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Mobile</label><input id="slug" name="slug" type="number"
                                                                                    class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                    value=""></div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Email</label><input id="slug" name="slug" type="email"
                                                                                    class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                    value=""></div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Date of birth</label>
                        <input id="slug" name="slug" type="date"
                                                                                    class="px-4 h-12 flex justify-between w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                    value=""></div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Address</label><input id="slug" name="slug" type="text"
                                                                                    class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                    value=""></div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">City</label><input id="slug" name="slug" type="text"
                                                                                    class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                    autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                    value=""></div>
                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Working Status</label><select class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12">
                                                 <option value="" selected=""></option>
                                                <option value="Employee">Employee</option>
                                               <option value="Government Employee">Government Employee</option>
                                                 <option value="Private Sector Employee">Private Sector Employee</option>
                                               <option value="Owner">Owner</option>
                                               <option value="Student">Student</option>
                                              <option value="Overseas Worker">Overseas Worker</option>
                                               <option value="Pensioner">Pensioner</option>
                                                   <option value="Unemployed">Unemployed</option>

                    </select>
                    </div>

                    <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="slug">Business Name</label><input id="slug" name="slug" type="text"
                                                                                class="px-4 h-12 flex items-center w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent h-12"
                                                                                autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"  aria-invalid="false"
                                                                                value=""></div>


                </div>
            </div>

            <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                    <h4 class="text-base font-semibold text-body-dark mb-2">Borrowers more details and files</h4>
                    <p class="text-sm text-body">Add some files</p>
                </div>
                <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                    <div>
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="description">Upload Borrowers Photo</label>
                        <div class="mt-1 flex items-center">
                            <img
                                v-if="model.image_url"
                                :src="model.image_url"
                                :alt="model.title"
                                class="w-64 h-48 object-cover"
                            />
                            <span
                                v-else
                                class="flex items-center justify-center h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-[80%] w-[80%] text-gray-300"
                    viewBox="0 0 20 20"
                    fill="currentColor">
                  <path
                      fill-rule="evenodd"
                      d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                      clip-rule="evenodd"
                  />
                </svg>
              </span>
                            <button
                                type="button"
                                class="relative overflow-hidden ml-5 bg-primary py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-100 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                <input
                                    type="file"
                                    @change="onImageChoose"
                                    class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer"
                                />
                                Change
                            </button>
                        </div>
                    </div>
                    <!--/ Image -->
                    <div class="relative mt-4">
                        <div class=""><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                             for="description">Description</label><textarea id="description" name="description"
                                                                                            class="py-3 px-4 w-full rounded appearance-none transition duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0 border border-border-base focus:border-accent"
                                                                                            autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="4"></textarea></div>
                    </div>
                </div>
            </div>
                <div class="flex flex-wrap pb-8 my-5 border-b border-dashed border-border-base sm:my-8">
                    <div class="w-full px-0 pb-5 sm:w-4/12 sm:py-8 sm:pe-4 md:w-1/3 md:pe-5">
                    </div>
                    <div class="rounded bg-white p-5 shadow md:p-8 w-full sm:w-8/12 md:w-2/3">
                        <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                               for="description">Add Borrowers additional Files</label>
                    <FileUpload mode="advanced" name="demo[]"   :multiple="true"  :show-upload-button="false"
                                :maxFileSize="1000000"  @select="onSelect">
                        <template #empty>
                            <p>Drag and drop files to here to upload.</p>
                        </template>
                    </FileUpload>
                    </div>
                </div>


            <div class="sticky bottom-0 -mx-5 bg-gray-100/10 py-3 px-5 backdrop-blur text-end md:py-5 lg:-mx-8 lg:px-8 z-0">
                <div class="mb-5 text-end"><button data-variant="normal"
                                                   class="inline-flex items-center justify-center flex-shrink-0 font-semibold leading-none rounded outline-none transition duration-300 ease-in-out focus:outline-none focus:shadow focus:ring-1 focus:ring-accent-700 bg-primary text-white border border-transparent hover:bg-primary px-5 py-0 h-12">Save</button>
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

let model = ref({
    image: null,
    image_url: null,

});


function onImageChoose(ev) {
    const file = ev.target.files[0];

    const reader = new FileReader();
    reader.onload = () => {
        // The field to send on backend and apply validations
        model.value.image = reader.result;

        // The field to display here
        model.value.image_url = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
}

const form = useForm({
    firstname: null,
    lastname: null,
    file: null,
    birth:null,
    address:null,
    gender:null,
    city:null,
    description:null,
    title:null,
    mobile:null,
    email:null,
    working:null,
    business:null,
    photo:model.value.image
});

const onSelect = (event) => {
    form.file= event.files[0];
};
</script>

<style scoped>
.custom-file-upload .p-fileupload-buttons {
    display: none;
}
</style>
