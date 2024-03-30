<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'inline-flex items-center px-4 py-3 w-full rounded-sm  border-l-2 border-primary text-primary  text-sm font-medium leading-5  transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1   text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 ' +
        'hover:text-primary focus:outline-none focus:text-gray-700 ' +
        'focus:text-primary transition duration-150 ease-in-out';
});
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
