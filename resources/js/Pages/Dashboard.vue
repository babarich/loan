<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {BanknotesIcon,UsersIcon,GiftTopIcon,CircleStackIcon} from '@heroicons/vue/24/outline'
import Chart from 'primevue/chart';

import { ref, onMounted } from "vue";

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
    chartLineData.value = setChartLineData();
    chartLineOptions.value = setChartLineOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'My First dataset',
                backgroundColor: documentStyle.getPropertyValue('--blue-500'),
                borderColor: documentStyle.getPropertyValue('--blue-500'),
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: 'My Second dataset',
                backgroundColor: documentStyle.getPropertyValue('--pink-500'),
                borderColor: documentStyle.getPropertyValue('--pink-500'),
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--text-color-secondary');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            legend: {
                labels: {
                    color: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                    font: {
                        weight: 500
                    }
                },
                grid: {
                    display: false,
                    drawBorder: false
                }
            },
            y: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false
                }
            }
        }
    };
}


const chartLineData = ref();
const chartLineOptions = ref();

const setChartLineData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
            {
                label: 'First Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: documentStyle.getPropertyValue('--blue-500'),
                tension: 0.4
            },
            {
                label: 'Second Dataset',
                data: [28, 48, 40, 19, 86, 27, 90],
                fill: false,
                borderColor: documentStyle.getPropertyValue('--pink-500'),
                tension: 0.4
            }
        ]
    };
};
const setChartLineOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--text-color-secondary');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.6,
        plugins: {
            legend: {
                labels: {
                    color: textColor
                }
            }
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder
                }
            },
            y: {
                ticks: {
                    color: textColorSecondary
                },
                grid: {
                    color: surfaceBorder
                }
            }
        }
    };
}

</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="grid gap-7 md:gap-8 lg:grid-cols-2 2xl:grid-cols-12">
                        <div class="col-span-full rounded-lg bg-white p-6 md:p-7">
                            <div class="mb-5 flex items-center justify-between md:mb-7"><h3
                                class="before:content-'' relative mt-1 bg-white text-lg font-semibold text-heading before:absolute before:-top-px before:h-7 before:w-1 before:rounded-tr-md before:rounded-br-md before:bg-emerald-700 before:-left-6 md:before:-top-0.5 md:before:-left-7 lg:before:h-8">Summary</h3>
                            </div>
                            <div class="grid w-full grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
                                <div
                                    class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-light p-5 md:p-6">
                                    <div class="mb-auto flex w-full items-center justify-between">
                                        <div
                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded bg-gray-100/80 me-3">
                                            <BanknotesIcon className="w-8 h-8"/>
                                        </div>
                                        <div class="flex w-full flex-col text-end"><span
                                            class="mb-1 text-base font-normal text-body">Total Revenue</span><span
                                            class="mb-2 text-2xl font-semibold text-heading">$1,818.80</span></div>
                                    </div>
                                </div>
                                <div
                                    class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-light p-5 md:p-6">
                                    <div class="mb-auto flex w-full items-center justify-between">
                                        <div
                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded bg-gray-100/80 me-3">
                                            <UsersIcon className="w-8 h-8"/>
                                        </div>
                                        <div class="flex w-full flex-col text-end"><span
                                            class="mb-1 text-base font-normal text-body">Total Borrowers</span><span
                                            class="mb-2 text-2xl font-semibold text-heading">14</span></div>
                                    </div>
                                </div>
                                <div class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-light p-5 md:p-6 border-b-color[rgb(215, 78, 255)]">
                                    <div class="mb-auto flex w-full items-center justify-between">
                                        <div
                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded bg-gray-100/80 me-3">
                                            <GiftTopIcon className="w-8 h-8"/>
                                        </div>
                                        <div class="flex w-full flex-col text-end"><span
                                            class="mb-1 text-base font-normal text-body">Payment Due</span><span
                                            class="mb-2 text-2xl font-semibold text-heading">11</span></div>
                                    </div>
                                </div>
                                <div
                                    class="flex h-full w-full flex-col rounded-lg border border-b-4 border-border-200 bg-light p-5 md:p-6">

                                    <div class="mb-auto flex w-full items-center justify-between">
                                        <div
                                            class="flex h-14 w-14 shrink-0 items-center justify-center rounded bg-gray-100/80 me-3">
                                            <CircleStackIcon className="w-4 h-4 text-blue-900"/>
                                        </div>
                                        <div class="flex w-full flex-col text-end"><span
                                            class="mb-1 text-base font-normal text-body">Payment This Week</span><span
                                            class="mb-2 text-2xl font-semibold text-heading">14</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg mb-6">
                        <div class="flex flex-row justify-between pb-6">
                            <div class="flex flex-col">
                                <h3 class="text-base font-bold">Monthly Payments</h3>
                                <span class="text-gray-500 text-sm">Monthly Payment and Loans</span>
                            </div>
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = ! open" class="text-gray-500 hover:text-gray-600 dark:hover:text-gray-400 transition-colors duration-200 focus:outline-none hover:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 bi bi-three-dots" viewBox="0 0 16 16">
                                        <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"></path>
                                    </svg>
                                </button>

                            </div>
                        </div>
                        <div class="relative">
                            <Chart type="bar" :data="chartData" :options="chartOptions" class="h-30rem"  />
                        </div>
                    </div>
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg h-full">
                        <div class="flex flex-row justify-between pb-6">
                            <div class="flex flex-col">
                                <h3 class="text-base font-bold">Revenue</h3>
                                <span class="text-gray-500 font-semibold text-sm">Today's Earning: <span class="text-green-500">$1,570.30</span></span>
                            </div>
                        </div>
                        <div class="relative">
                            <Chart type="line" :data="chartLineData" :options="chartLineOptions" class="h-30rem" />
                        </div>
                    </div>

                </div>

                <div class="bg-white relative overflow-x-auto mt-4">
                    <h3 class="py-4 px-4 mb-6 mt-2 text-md font-semibold">Latest Payments</h3>
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
                                Customer
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Status
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Date Added
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Total
                            </th>
                            <th
                                scope="col"
                                class="py-4 px-4 border text-xs text-left whitespace nowrap font-semibold">
                                Action
                            </th>

                        </tr>

                        </thead>
                        <tbody>
                        <tr class="odd:bg-gray-100 focus-within:bg-gray-100">
                            <td class="py-4 px-4 text-sm text-left border">
                                1
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">
                                INV1234
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">
                                John Baptist
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">
                                <span class="bg-emerald-600 text-emerald-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full">Paid</span>
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">
                                12-10-2023
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">
                                350
                            </td>
                            <td class="py-4 px-4 text-sm text-left border">

                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
