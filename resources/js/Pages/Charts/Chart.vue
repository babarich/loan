<script setup>
import {ref, watch} from 'vue'
import VueApexCharts from 'vue3-apexcharts'


const dataChart = ref([]);
const props = defineProps({
    chartData:Object,projectedData:Object, interestProjected:Object,interestPaid:Object,
    principlePaid:Object,principleProjected:Object
});


watch(props, (value) =>{
    let dtChart = props.chartData.data || [];
    dataChart.value = dtChart
})
const todayData = {
    series: [
        {
            name: 'Amount',
            data: dataChart
        }
    ],
    labels: props.chartData.labels
}


const apexOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.chartData.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
const apexProjectedOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.projectedData.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
const apexInterestProjOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.interestProjected.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
const apexInterestOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.interestPaid.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
const apexPrincipleOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.principlePaid.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
const apexPrincipleProjOptions = {
    legend: {
        show: false,
        position: 'top',
        horizontalAlign: 'left'
    },
    colors: ['#3C50E0'],
    chart: {
        fontFamily: 'Satoshi, sans-serif',
        height: 335,
        type: 'area',
        dropShadow: {
            enabled: true,
            color: '#623CEA14',
            top: 10,
            blur: 4,
            left: 0,
            opacity: 0.1
        },

        toolbar: {
            show: false
        }
    },
    responsive: [
        {
            breakpoint: 1024,
            options: {
                chart: {
                    height: 300
                }
            }
        },
        {
            breakpoint: 1366,
            options: {
                chart: {
                    height: 350
                }
            }
        }
    ],
    stroke: {
        width: [2, 2],
        curve: 'straight'
    },

    labels: {
        show: false,
        position: 'top'
    },
    grid: {
        xaxis: {
            lines: {
                show: true
            }
        },
        yaxis: {
            lines: {
                show: true
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    markers: {
        size: 4,
        colors: '#fff',
        strokeColors: ['#3056D3'],
        strokeWidth: 3,
        strokeOpacity: 0.9,
        strokeDashArray: 0,
        fillOpacity: 1,
        discrete: [],
        hover: {
            size: undefined,
            sizeOffset: 5
        }
    },
    xaxis: {
        type: 'category',
        categories: props.principleProjected.labels,
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        }
    },
    yaxis: {
        title: {
            style: {
                fontSize: '0px'
            }
        },
        min: 0,
        max: 100
    }
}
</script>

<template>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                    <div class="w-full">
                        <p class="font-semibold text-primary">Total Paid -Monthly</p>
                    </div>
            </div>

        </div>

        <div>
            <div id="chartOne" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexOptions"
                    :series="chartData.series"
                />
            </div>
        </div>
    </div>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                <div class="w-full">
                    <p class="font-semibold text-red-500">Total Payment Projection -Monthly</p>
                </div>
            </div>

        </div>
        <div>
            <div id="chartTwo" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexProjectedOptions"
                    :series="projectedData.series"

                />
            </div>
        </div>
    </div>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                <div class="w-full">
                    <p class="font-semibold text-primary">Interest Paid -Monthly</p>
                </div>
            </div>

        </div>
        <div>
            <div id="chartThree" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexInterestOptions"
                    :series="interestPaid.series"
                />
            </div>
        </div>
    </div>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                <div class="w-full">
                    <p class="font-semibold text-red-500">Interest Projected -Monthly</p>
                </div>
            </div>

        </div>
        <div>
            <div id="chartFour" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexInterestProjOptions"
                    :series="interestProjected.series"

                />
            </div>
        </div>
    </div>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                <div class="w-full">
                    <p class="font-semibold text-primary">Total Principle -Monthly</p>
                </div>
            </div>

        </div>
        <div>
            <div id="chartFive" class="-ml-5">
                <VueApexCharts
                    type="area"
                    height="350"
                    :options="apexPrincipleOptions"
                    :series="principlePaid.series"

                />
            </div>
        </div>
    </div>
    <div
        class="col-span-12 rounded-sm border border-stroke bg-white px-5 pt-7.5 pb-5
        shadow-default  sm:px-7.5 xl:col-span-6">
        <div class="flex flex-wrap items-start justify-between gap-3 sm:flex-nowrap">
            <div class="flex w-full flex-wrap gap-3 sm:gap-5 mt-4">
                <div class="w-full">
                    <p class="font-semibold text-red-500">Principle Projected -Monthly</p>
                </div>
            </div>

        </div>
        <div>
            <div id="chartSix" class="-ml-5">
                <VueApexCharts
                    type="line"
                    height="350"
                    :options="apexPrincipleOptions"
                    :series="principleProjected.series"

                />
            </div>
        </div>
    </div>
</template>
