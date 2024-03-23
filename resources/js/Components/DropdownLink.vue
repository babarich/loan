<script setup>
import { Link } from '@inertiajs/vue3';
import {computed} from "vue";



const props = defineProps({
    href: String,
    active: Boolean,
    as: String,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-4 py-3 w-full rounded-sm  bg-gray-100 border-l-2 border-primary text-primary  text-sm font-medium leading-5  transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1   text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 hover:text-primary transition duration-150 ease-in-out">
            <slot />
        </button>

        <a v-else-if="as =='a'" :href="href" class="block px-4 py-2 text-sm leading-5 text-gray-300 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition  hover:text-primary  duration-150 ease-in-out">
            <slot />
        </a>

        <Link v-else :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
