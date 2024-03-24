<template>
    <div v-if="shouldDisplayLinks">
        <div class="flex justify-between">
            <div class="flex flex-wrap -mb-1">
                <template v-for="(link, index) in links" :key="index">
                    <div v-if="link.url === null"  class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                         @click="emitPageChange(event)">
                        <span v-html="link.label"></span>
                    </div>
                    <Link v-else  class="mb-1 mr-1 px-4 py-3 focus:text-primary text-sm leading-4 hover:bg-gray-50 border focus:border-indigo-700 rounded"
                          :class="{ 'bg-primary text-white': link.active }"
                          :href="link.url"
                          @click="emitPageChange(event)">
                        <span v-html="link.label"></span>
                    </Link>
                </template>
                <div class="flex">
                    <select
                        @change="getPage"
                        v-model="localPerPage"
                        class="appearance-none relative block w-14 px-2 py-1 border border-gray-300 placeholder-gray-500 text-gray-900
                    rounded-md focus:outline-none focus:ring-primary focus:border-primary focus:z-10 sm:text-sm">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>
            <div>
                <p class="py-2 px-2 text-gray-600 leading-4">Showing {{data.from}} to {{data.to}} of {{data.total}} results</p>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link,
    },
    props: {
        links: {
            type: Array,
            required: true
        },
        data: {
            type: Object,
            required: true
        },
        perPage: {
            type: Number,
            default: 10
        }
    },
    data() {
        return {
            localPerPage: this.perPage
        }
    },
    computed: {
        shouldDisplayLinks() {
            console.log(this.links.length)
            return this.links.length > 3;
        },
    },
    methods: {
        emitPageChange(event) {
            event.preventDefault();
            this.$emit('page-change');
        },
        getPage() {
            this.$emit('getPage', this.localPerPage);
        }
    },
    emits: ['page-change', 'getPage']
}
</script>
