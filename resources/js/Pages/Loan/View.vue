<template>
<AppLayout>
    <div class="mt-4 mb-3 flex flex-col md:flex-row items-center justify-between">
        <div>

        </div>
        <div class="flex justify-between">
            <a   class="px-4 text-sm flex text-gray-100 bg-boxdark p-2 rounded mr-4">
                <i class="pi pi-cloud-download w-4 h-4 mr-2"></i>  Download
            </a>

            <a :href="route('borrow.index')" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                <ArrowLeftIcon class="w-4 h-4 mr-2"/>  Back
            </a>
        </div>
    </div>
    <div class="bg-gray-100">
        <div class="p-2 mx-auto py-8">
            <div class="intro-y mt-5 grid grid-cols-12 gap-5">
                <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="m-10 max-w-sm">
                                <div class="relative mx-auto w-52 rounded-full">
                                    <img :src="loan.borrower.filename" class="object-cover h-52 bg-gray-300 rounded-md mb-4 shrink-0" :alt="loan.borrower.first_name" />
                                </div>
                                <h1 class="my-1 text-center text-xl font-bold leading-8 text-gray-900">{{uppercase(loan.borrower.first_name)}} {{uppercase(loan.borrower.last_name)}}</h1>
                                <h3 class="font-lg text-semibold text-center leading-6 text-gray-600">{{loan.borrower.business_name}}, {{loan.borrower.working_status}}</h3>
                                <ul class="mt-3 divide-y rounded bg-gray-100 py-2 px-3 text-gray-600 shadow-sm hover:text-gray-700 hover:shadow">
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Age</span>
                                        <span class="ml-auto">{{loan.borrower.age}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Gender</span>
                                        <span class="ml-auto">{{uppercase(loan.borrower.gender)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Joined On</span>
                                        <span class="ml-auto">{{formatDate(loan.borrower.created_at)}}</span>
                                    </li>
                                    <li class="flex flex-col md:flex-row items-center py-3 text-sm">
                                        <span class="text-primary font-semibold">Loan Officer</span>
                                        <span class="ml-auto">{{loan.user.name}}</span>
                                    </li>
                                </ul>

                        </div>


                    </div>
                </div>
                <div class="col-span-12 lg:col-span-8 2xl:col-span-9">
                    <div class="bg-white shadow rounded-lg p-6 divide-y ">
                        <h2 class="text-xl font-bold mb-4">Loan Information</h2>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Loan Id</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.reference}}</span>
                            </p>
                        </div>

                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Loan Product</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.product.name}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Loan Release Date</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.loan_release_date}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Disbursement Method</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{uppercase(loan.disbursement)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Principle Amount</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{formatCurrency(loan.principle_amount)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Total Interest</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{formatCurrency(loan.total_interest)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Interest</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.interest_percentage ? loan.interest_percentage + '%' : loan.interest_amount}} per {{loan.interest_duration}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Interest Type</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.interest_method}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Loan Duration</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.loan_duration}} {{loan.duration_type}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Repayment Cycle</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.payment_number}} {{loan.payment_cycle}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Total Due </span>
                            <p>
                                <span class="text-gray-700 mr-2">{{formatCurrency(loan.loanpayment.due_amount)}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Total Paid Amount </span>
                            <p>
                                <span class="text-gray-700 mr-2">{{ loan.loanpayment.paid_amount ? formatCurrency(loan.loanpayment.paid_amount) : 0}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Approval Status </span>
                            <span class="bg-yellow-500 text-white p-2 rounded-md text-xs mt-2" v-if="loan.status === 'pending'">
                            Pending
                        </span>
                            <span class="bg-emerald-500 text-white p-2 rounded-md text-xs mt-2" v-else>
                            Approved
                        </span>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Total Paid Amount </span>
                            <p>
                                <span class="text-gray-700 mr-2">{{ loan.loanpayment.paid_amount ? formatCurrency(loan.loanpayment.paid_amount) : 0}}</span>
                            </p>
                        </div>
                        <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                            <span class="text-primary font-bold">Description</span>
                            <p>
                                <span class="text-gray-700 mr-2">{{loan.description}}</span>
                            </p>
                        </div>

                    </div>
                </div>

            </div>


            <div class="rounded bg-white p-5 shadow md:p-8 w-full mt-4">
                <TabView v-model:activeIndex="active"  orientation="right">
                    <TabPanel>

                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                                <span  :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 0,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 0
                                }
                                ]"><i class="pi pi-database mr-2 mt-2"></i>Re-Payments</span>
                            </div>
                        </template>


                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold mb-4 text-red-600">Loan Repayments </h2>
                            </div>
                            <div v-if="loan.stage > 3">
                                <button  @click="payment = true" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                    <PlusIcon class="w-4 h-4 mr-2"/>  Add Repayment
                                </button>
                            </div>

                        </div>

                        <Dialog v-model:visible="payment" modal header="Add Loan Payment" :position="top" style="width:50%">
                            <form @submit.prevent="submitPayment">
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Payment Cycle</label>
                                    <CustomInput
                                        required
                                        type="select"
                                        :select-options="cycleOptions"
                                        v-model="paymentForm.schedule"

                                    />
                                    <p v-if="errors.schedule">{{errors.schedule}}</p>
                                </div>

                                <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                                         for="slug">Amount </label>
                                    <InputNumber class="w-full border border-gray-300 placeholder-gray-600 text-gray-900" v-model="paymentForm.amount" inputId="integeronly"
                                                 required/>
                                    <p v-if="errors.amount">{{errors.amount}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Payment Date</label>
                                    <CustomInput type="date" v-model="paymentForm.date" :class="{'border-red-500' : errors.date}" required/>
                                    <p v-if="errors.date">{{errors.date}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Payment  Method</label>
                                    <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="paymentForm.type" :class="{'border-red-500' : errors.type}">
                                        <option value="">select..</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Bank">Bank</option>
                                        <option value="Cheque">Cheque</option>
                                        <option value="Mobile Transfer">mobile Transfer</option>
                                    </select>
                                    <p v-if="errors.type">{{errors.type}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Description</label>
                                    <CustomInput type="textarea" rows="3" v-model="paymentForm.description" :class="{'border-red-500' : errors.description}" required/>
                                    <p v-if="errors.description">{{errors.description}}</p>
                                </div>

                                <div class="flex flex-col md:flex-row justify-between mt-8">
                                    <div>

                                    </div>

                                    <div>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="payment = false">Cancel</button>
                                        <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                                    </div>

                                </div>
                            </form>
                        </Dialog>

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
                                        Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Collected By
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Method
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Amount
                                    </th>

                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Receipt
                                    </th>

                                </tr>

                                </thead>
                                <tbody>
                                <tr v-for="(payment,index) in loan.payments" :key="index" class="odd:bg-gray-100 focus-within:bg-gray-100">
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{index + 1}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">{{payment.payment_date}}</td>
                                    <td class="py-4 px-4 text-sm text-left border">{{payment.user.name}}</td>

                                    <td class="py-4 px-4 text-sm text-left border"> {{
                                            payment.type
                                        }}</td>
                                    <td class="py-4 px-4 text-sm text-left border"> {{
                                            formatCurrency(payment.amount)
                                        }}</td>

                                    <td class="py-4 px-4 text-sm text-left border"></td>

                                </tr>
                                <tr v-if="loan.payments.length === 0">
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
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 1,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 1
                                }
                                ]"><i class="pi pi-file-pdf mr-2 mt-2"></i>Terms</span>
                            </div>
                        </template>

                        <h3 class="text-primary text-xl font-semibold">Loan Term</h3>
                        <div class="p-6 divide-y ">
                            <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                                <span class="text-primary font-bold">Loan Reminders</span>
                                <p>
                                    <span class="text-gray-700 mr-2">None</span><br>
                                    <span class="text-blue-800">set loan reminder</span>
                                </p>
                            </div>

                            <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                                <span class="text-primary font-bold">Loan Status </span>
                                <span class="bg-yellow-500 text-white p-2 rounded-md text-xs mt-2" v-if="loan.status === 'pending'">
                            Pending
                        </span>
                                <span class="bg-emerald-500 text-white p-2 rounded-md text-xs mt-2" v-else>
                            Approved
                        </span>
                            </div>
                            <div class="flex justify-between flex-wrap gap-2 w-full mb-6">
                                <span class="text-primary font-bold">Loan Added on</span>
                                <p>
                                    <span class="text-gray-700 mr-2">{{loan.created_at}}</span><br>

                                </p>
                            </div>
                        </div>
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold mb-4 text-red-600">Loan Agreement Files</h2>
                            </div>
                            <div>
                                <button label="Show" @click="visible = true" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                    <PlusIcon class="w-4 h-4 mr-2"/>  Add Agreement File
                                </button>
                            </div>

                        </div>
                        <Dialog v-model:visible="visible" modal header="Add Agreement File">
                            <form @submit.prevent="submitAgreement">
                            <div class="mb-5">
                                <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                       for="slug">File Name</label>
                                <CustomInput type="text" v-model="form.filename" :class="{'border-red-500' : errors.filename}" required/>
                                <p v-if="errors.filename">{{errors.filename}}</p>
                            </div>
                            <div class="mb-5">
                                <span class="text-sm">File</span>
                                <div
                                    class="flex items-center space-x-6 border rounded-md px-1 py-2"
                                >
                                    <label class="block">
                                        <div class="custom-file-input">
                                            <input
                                                type="file"
                                                id="fileInput"
                                                class="hidden"
                                                @change="handleFileChange"
                                            />
                                            <div
                                                for="fileInput"
                                                class="file-label flex"
                                                style="border-radius: 0.375rem"
                                            >
                                                <CloudArrowUpIcon
                                                    class="w-7 h-7 text-blue-900 cursor-pointer"
                                                />
                                                <p>Choose File</p>
                                            </div>
                                        </div>
                                    </label>
                                    <p class="selected-file">{{ form.name }}</p>
                                </div>
                                <span class="text-sm text-red-500" v-if="errors.file">{{
                                        errors.file[0]
                                    }}</span>
<!--                                <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"-->
<!--                                       for="slug">Upload File</label>-->
<!--                            <input  type="file"   @change="onFileChoose" :class="{'border-red-500' : errors.file}" required/>-->
<!--                                <p v-if="errors.file">{{errors.file}}</p>-->
                            </div>
                            <div class="flex flex-col md:flex-row justify-between mt-8">
                                <div>

                                </div>

                                <div>
                                    <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="visible = false">Cancel</button>
                                    <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                                </div>

                            </div>
                            </form>
                        </Dialog>
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
                                        File Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Attachment Size
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Uploaded By
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Action
                                    </th>

                                </tr>

                                </thead>
                                <tbody>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                                    v-for="(attach, index) in loan.agreements" :key="index">
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{index + 1}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{attach.name}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{attach.attachment_size}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{attach.user ? attach.user.name : 'N/A'}}
                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        <div class="flex justify-between flex-col md:flex-row items-center">
                                            <div class="flex items-center space-x-2 divide-x">
                                        <a :href="route('loan.download', attach.id)" class="text-sm flex text-gray-100 bg-primary p-2 rounded">
                                            <CloudArrowDownIcon class="w-4 h-4 mr-2"/> Download
                                        </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 2,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 2
                                }
                                ]"><i class="pi pi-clock mr-2 mt-2"></i>Schedules</span>
                            </div>
                        </template>
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
                                        Due Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Principle
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Interest
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Penalty
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Fees
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Interest Paid
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Principle Paid
                                    </th>

                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Due Amount
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Status
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                                    v-for="(schedule, index) in loan.schedules" :key="index">
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{index + 1}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{schedule.due_date}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(schedule.principle)}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(schedule.interest)}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                      {{schedule.interest_paid ? formatCurrency(schedule.interest_paid) : 0.00}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                       {{schedule.principal_paid ? formatCurrency(schedule.principal_paid) : 0.00}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(schedule.amount)}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                          <span class="bg-yellow-400 text-gray-900 p-3 rounded-md" v-if="schedule.status === 'pending'">Pending</span>
                                          <span class="bg-red-400 text-gray-800 rounded-md p-3" v-else-if="schedule.status === 'due'">Due</span>
                                          <span class="bg-emerald-500 text-gray-900 rounded-md p-3" v-else-if="schedule.status === 'completed'">Completed</span>
                                          <span class="bg-red-200 text-gray-900 rounded-md p-3" v-else-if="schedule.status === 'partial'">Partial Paid</span>
                                          <span v-else class="bg-red-600 text-gray-100 rounded-md p-3">Overdue</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 3,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 3
                                }
                                ]"><i class="pi pi-list mr-2 mt-2"></i> Pending Dues</span>
                            </div>
                        </template>
                        <div class="bg-white relative overflow-x-auto mt-4">
                            <table class="w-full text-sm whitespace-nowrap">
                                <thead class="sticky top-0">
                                <tr>
                                    <td><h3 class="text-primary font-semibold text-xl">Based on Loan Terms</h3></td>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold">
                                        Principle
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold">
                                        Interest
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold">
                                        Penalty
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold">
                                        Fees
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace-nowrap font-semibold">
                                       Total
                                    </th>

                                </tr>

                                </thead>
                                <tbody>

                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                                    <th scope="row" class="py-2 px-2 bg-red-400 text-gray-900">Total Due</th>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.principle_amount)}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.total_interest)}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(sum(loan.principle_amount,loan.total_interest))}}
                                    </td>

                                </tr>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                                    <th scope="row" class="py-2 px-2 bg-emerald-400 text-gray-200">Total Paid</th>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.principle_amount)}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.total_interest)}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(sum(loan.principle_amount,loan.total_interest))}}
                                    </td>

                                </tr>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                                    <th scope="row" class="py-2 px-2 bg-blue-400 text-gray-300">Balance</th>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.principle_amount)}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(loan.total_interest)}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">

                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{formatCurrency(sum(loan.principle_amount,loan.total_interest))}}
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 4,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 4
                                }
                                ]"><i class="pi pi-box mr-2 mt-2"></i> Collaterals</span>
                            </div>
                        </template>
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold mb-4 text-red-600">Loan Collaterals </h2>
                            </div>
                            <div>
                                <button  @click="collateral = true" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                    <PlusIcon class="w-4 h-4 mr-2"/>  Add Collateral
                                </button>
                            </div>

                        </div>

                        <Dialog v-model:visible="collateral" modal header="Add Loan Collateral" :position="top" style="width:50%">
                            <form @submit.prevent="submitCollateral">
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Collateral Type</label>
                                    <CustomInput
                                        required
                                        type="select"
                                        :select-options="typeOptions"
                                        v-model="collateralForm.typeId"

                                    />
                                    <p v-if="errors.typeId">{{errors.typeId}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Product Name</label>
                                    <CustomInput type="text" v-model="collateralForm.product_name" :class="{'border-red-500' : errors.product_name}" required/>
                                    <p v-if="errors.product_name">{{errors.product_name}}</p>
                                </div>
                                <div class="mb-5"><label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                                         for="slug">Value </label>
                                    <InputNumber class="w-full border border-gray-300 placeholder-gray-600 text-gray-900" v-model="collateralForm.amount" inputId="integeronly"
                                    required/>
                                    <p v-if="errors.amount">{{errors.amount}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Registered Date</label>
                                    <CustomInput type="date" v-model="collateralForm.date" :class="{'border-red-500' : errors.date}" required/>
                                    <p v-if="errors.date">{{errors.date}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Product Condition</label>
                                    <select class="px-4 h-12 flex items-center w-full rounded appearance-none transition
                        duration-300 ease-in-out text-heading text-sm focus:outline-none focus:ring-0
                        border border-border-base focus:border-accent h-12" v-model="collateralForm.condition" :class="{'border-red-500' : errors.condition}">
                                        <option value="">select..</option>
                                        <option value="Excellent">Excellent</option>
                                        <option value="Good">Good</option>
                                        <option value="Fair">Fair</option>
                                        <option value="Bad">Bad</option>
                                        <option value="Worst">Worst</option>
                                    </select>
                                    <p v-if="errors.condition">{{errors.condition}}</p>
                                </div>
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Description</label>
                                    <CustomInput type="textarea" rows="3" v-model="collateralForm.comment" :class="{'border-red-500' : errors.comment}" required/>
                                    <p v-if="errors.comment">{{errors.comment}}</p>
                                </div>
                                <div class="mb-5">
                                    <span class="text-sm">Collateral File</span>
                                    <div
                                        class="flex items-center space-x-6 border rounded-md px-1 py-2"
                                    >
                                        <label class="block">
                                            <div class="custom-file-input">
                                                <input
                                                    type="file"
                                                    id="fileInput"
                                                    class="hidden"
                                                    @change="handleCollateralChange"
                                                />
                                                <div
                                                    for="fileInput"
                                                    class="file-label flex"
                                                    style="border-radius: 0.375rem"
                                                >
                                                    <CloudArrowUpIcon
                                                        class="w-7 h-7 text-blue-900 cursor-pointer"
                                                    />
                                                    <p>Choose File</p>
                                                </div>
                                            </div>
                                        </label>
                                        <p class="selected-file">{{ collateralForm.name }}</p>
                                    </div>
                                    <span class="text-sm text-red-500" v-if="errors.file">{{
                                            errors.file[0]
                                        }}</span>

                                </div>
                                <div class="flex flex-col md:flex-row justify-between mt-8">
                                    <div>

                                    </div>

                                    <div>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="visible = false">Cancel</button>
                                        <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                                    </div>

                                </div>
                            </form>
                        </Dialog>
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
                                        Product Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Registered Date
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Value
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Condition
                                    </th>

                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Created By
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Action
                                    </th>
                                </tr>

                                </thead>
                                <tbody>
                            <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                                v-for="(col, index) in loan.collaterals" :key="index">
                                <td class="py-4 px-4 text-sm text-left border">
                                    {{index + 1}}
                                </td>

                                <td class="py-4 px-4 text-sm text-left border">
                                    {{col.product_name}}
                                </td>
                                <td class="py-4 px-4 text-sm text-left border">
                                    {{col.date}}
                                </td>
                                <td class="py-4 px-4 text-sm text-left border">
                                    {{formatCurrency(col.amount)}}
                                </td>

                                <td class="py-4 px-4 text-sm text-left border">
                                    {{col.condition}}
                                </td>
                                <td class="py-4 px-4 text-sm text-left border">
                                    {{col.user ? col.user.name : 'N/A'}}
                                </td>


                                <td class="py-4 px-4 text-sm text-left border">
                                    <div class="flex justify-between flex-col md:flex-row items-center">
                                        <div class="flex items-center space-x-2 divide-x" v-if="col.attachment">
                                            <a :href="route('collateral.download', col.id)" class="text-sm flex text-gray-100 bg-primary p-2 rounded">
                                                <CloudArrowDownIcon class="w-4 h-4 mr-2"/> Download
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                </tbody>
                            </table>
                        </div>
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 5,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 5
                                }
                                ]"><i class="pi pi-file-excel mr-2 mt-2"></i> Files</span>
                            </div>
                        </template>
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold mb-4 text-red-600">Loan  Files</h2>
                            </div>
                            <div>
                                <button label="Show" @click="loanFile = true" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                    <PlusIcon class="w-4 h-4 mr-2"/>  Add  File
                                </button>
                            </div>

                        </div>
                        <Dialog v-model:visible="loanFile" modal header="Add Loan File" style="width:50%">
                            <form @submit.prevent="submitLoanFile">
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">File Name</label>
                                    <CustomInput type="text" v-model="loanForm.filename" :class="{'border-red-500' : errors.filename}" required/>
                                    <p v-if="errors.filename">{{errors.filename}}</p>
                                </div>
                                <div class="mb-5">
                                    <span class="text-sm">File</span>
                                    <div
                                        class="flex items-center space-x-6 border rounded-md px-1 py-2"
                                    >
                                        <label class="block">
                                            <div class="custom-file-input">
                                                <input
                                                    type="file"
                                                    id="fileInput"
                                                    class="hidden"
                                                    @change="handleLoanChange"
                                                />
                                                <div
                                                    for="fileInput"
                                                    class="file-label flex"
                                                    style="border-radius: 0.375rem"
                                                >
                                                    <CloudArrowUpIcon
                                                        class="w-7 h-7 text-blue-900 cursor-pointer"
                                                    />
                                                    <p>Choose File</p>
                                                </div>
                                            </div>
                                        </label>
                                        <p class="selected-file">{{ loanForm.name }}</p>
                                    </div>
                                    <span class="text-sm text-red-500" v-if="errors.file">{{
                                            errors.file[0]
                                        }}</span>

                                </div>
                                <div class="flex flex-col md:flex-row justify-between mt-8">
                                    <div>

                                    </div>

                                    <div>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="visible = false">Cancel</button>
                                        <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                                    </div>

                                </div>
                            </form>
                        </Dialog>
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
                                        File Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Attachment Size
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Uploaded By
                                    </th>
                                    <th
                                        scope="col"
                                        class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                        Action
                                    </th>

                                </tr>

                                </thead>
                                <tbody>
                                <tr class="odd:bg-gray-100 focus-within:bg-gray-100"
                                    v-for="(file, index) in loan.files" :key="index">
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{index + 1}}
                                    </td>

                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{file.name}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{file.attachment_size}}
                                    </td>
                                    <td class="py-4 px-4 text-sm text-left border">
                                        {{file.user ? file.user.name : 'N/A'}}
                                    </td>



                                    <td class="py-4 px-4 text-sm text-left border">
                                        <div class="flex justify-between flex-col md:flex-row items-center">
                                            <div class="flex items-center space-x-2 divide-x">
                                                <a :href="route('collateral.downloadFile', file.id)" class="text-sm flex text-gray-100 bg-primary p-2 rounded">
                                                    <CloudArrowDownIcon class="w-4 h-4 mr-2"/> Download
                                                </a>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </TabPanel>
                    <TabPanel>
                        <template #header="{ index }">
                            <div class="flex align-items-center gap-2 py-2 px-4 rounded-md">
                            <span :class="[
                                'font-bold white-space-nowrap text-lg inline-flex',
                                {
                                'bg-primary border-primary text-white p-3 rounded-md':  active === 6,
                                'bg-gray-200 text-primary p-3 rounded-md': active !== 6
                                }
                                ]"><i class="pi pi-comments mr-2 mt-2"></i> Comments</span>
                            </div>
                        </template>
                        <div class="flex flex-col md:flex-row justify-between">
                            <div>
                                <h2 class="text-xl font-bold mb-4 text-red-600">Loan  Comments</h2>
                            </div>
                            <div>
                                <button label="Show" @click="commentLoan = true" class="px-4 text-sm flex text-gray-100 bg-primary p-2 rounded">
                                    <PlusIcon class="w-4 h-4 mr-2"/>  Add  Comment
                                </button>
                            </div>

                        </div>
                        <Dialog v-model:visible="commentLoan" modal header="Add Loan Comment" style="width:50%">
                            <form @submit.prevent="submitComment">
                                <div class="mb-5">
                                    <label class="flex text-body-dark font-semibold text-sm leading-none mb-3"
                                           for="slug">Comment </label>
                                    <CustomInput type="text" v-model="commentForm.comment" :class="{'border-red-500' : errors.comment}" required/>
                                    <p v-if="errors.comment">{{errors.comment}}</p>
                                </div>

                                <div class="flex flex-col md:flex-row justify-between mt-8">
                                    <div>

                                    </div>

                                    <div>
                                        <button type="button" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2 rounded-md text-base bg-gray-200 font-medium text-gray-600
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" label="Cancel" severity="secondary" @click="visible = false">Cancel</button>
                                        <NButtonLoading type="submit"   :loading="loading" class="mt-3 w-full inline-flex justify-center
                                 shadow-sm px-4 py-2  text-base font-medium text-gray-700
                                focus:outline-none focus:ring-2 focus:ring-offset-2
                                focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Save</NButtonLoading>
                                    </div>

                                </div>
                            </form>
                        </Dialog>
                        <article class="p-6 text-base bg-white rounded-lg shadow-md mb-3"
                        v-for="(comment,index) in loan.comments" :key="index">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <div class="flex mx-auto mr-4">
                                        <div
                                            class="relative inline-flex items-center justify-center w-12 h-12 overflow-hidden bg-primary  mr-4 rounded-full"><span
                                    class="font-medium text-white text-xl">{{ getInitials(comment.user.name) }}</span>
                                        </div>
                                        <h1 class="py-2   text-xl font-bold leading-8 text-gray-900">{{uppercase(comment.user.name)}}</h1>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <time>{{comment.created_at}}</time></p>
                                </div>
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{comment.description}}</p>

                        </article>
                    </TabPanel>
                </TabView>

            </div>
        </div>
    </div>
</AppLayout>
</template>


<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {ArrowLeftIcon, ArrowUpTrayIcon, DocumentArrowDownIcon, FunnelIcon,
    PlusIcon,CloudArrowUpIcon,CloudArrowDownIcon} from "@heroicons/vue/24/outline";
import moment from "moment";
import SearchFilter from "@/Shared/SearchFilter.vue";
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel';
import Dialog from 'primevue/dialog';
import {computed, ref} from 'vue'
import CustomInput from "@/Shared/CustomInput.vue";
import NButtonLoading from "@/Shared/NButtonLoading.vue";
import {useForm} from "@inertiajs/vue3";
import "primevue/resources/primevue.min.css"
import InputNumber from "primevue/inputnumber";

const props = defineProps({
    loan:Object,errors:Object, types:Object
})



const visible = ref(false);

const collateral = ref(false);

const loanFile = ref(false);

const commentLoan = ref(false);


const payment = ref(false);

const active = ref(0)



const loading = ref(false);
function uppercase(str){
    return str.charAt(0).toUpperCase() + str.slice(1);
}



function sum(a,b){
    return parseFloat(a)+ parseFloat(b);
}

const form  = useForm({
   'filename': null,
   'file':null,
    'name' : null
});

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
const collateralForm = useForm({
     'typeId':null,
     'name':null,
    'product_name':null,
    'amount':null,
    'date':null,
    'condition':null,
    'comment':null,
    'file':null,


});

const loanForm  = useForm({
    'filename': null,
    'file':null,
    'name' : null
});



const paymentForm  = useForm({
    'amount': null,
    'type':null,
    'date' : null,
    'schedule':null,
    'description':null
});


const commentForm = useForm({
    'comment':null
});
function formatCurrency (value, decimals=2, thousandsSeparator= ','){
    let result = parseFloat(value).toFixed(decimals).toString();
    if(thousandsSeparator) result = result.replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator)
    return result;
}
function formatDate(dateString) {
  const date = moment(dateString);
  return date.format("DD-MM-YYYY");
}


const handleFileChange = (ev) => {
    const file = ev.target.files[0];
     form.name = ev.target.files[0].name;
     form.file = file

};

const handleLoanChange = (ev) => {
    const file = ev.target.files[0];
    loanForm.name = ev.target.files[0].name;
    loanForm.file = file

};

const handleCollateralChange = (ev) => {
    const file = ev.target.files[0];
    collateralForm.name = ev.target.files[0].name;
    collateralForm.file = file

};
function onFileChoose(ev) {
    const file = ev.target.files[0];
    const reader = new FileReader();
    reader.onload = () => {
        form.file = reader.result;
        ev.target.value = "";
    };
    reader.readAsDataURL(file);
}


const typeOptions = computed(() =>
    props.types.map((c) => ({
        key: c.id,
        text: `${c.name}`,
        value: c.id,
    }))
);


const cycleOptions = computed(() =>
    props.loan.cycles.map((c) => ({
        key: c.id,
        text: `${c.due_date} - ${c.amount}`,
        value: c.id,
    }))
);

function submitAgreement(){
    loading.value = true
    form.post(route('loan.attachment', props.loan.id),{
        onSuccess:()=>{
            loading.value = false
            visible.value = false
        },
        onError:()=>{
            loading.value = false
        }
    })
}


function submitCollateral(){
    loading.value = true
    collateralForm.post(route('collateral.store', props.loan.id),{
        onSuccess:()=>{
            loading.value = false
            collateral.value = false
            collateralForm.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}

function submitLoanFile(){
    loading.value = true
    loanForm.post(route('collateral.attach', props.loan.id),{
        onSuccess:()=>{
            loading.value = false
            loanFile.value = false
            loanForm.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}

function submitComment(){
    loading.value = true
    commentForm.post(route('collateral.comment', props.loan.id),{
        onSuccess:()=>{
            loading.value = false
            loanComment.value = false
            commentForm.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}


function submitPayment(){
    loading.value = true
    paymentForm.post(route('loan.payment', props.loan.id),{
        onSuccess:()=>{
            loading.value = false
            payment.value = false
            paymentForm.reset()
        },
        onError:()=>{
            loading.value = false
        }
    })
}
</script>

<style scoped>
.custom-file-input {
    display: inline-block;
    position: relative;
}

.file-label {
    background-color: #e6e5f1;
    color: #262424;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

/* Style the hidden file input */
.hidden {
    display: none;
}
</style>
