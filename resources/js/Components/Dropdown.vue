<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'center',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: Array,
        default: () => ['py-1'],
    },
});

let open = ref(false);

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const widthClass = computed(() => {
    return {
        '48': 'w-48',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'origin-top-left left-0';
    }

    if (props.align === 'right') {
        return 'origin-top-right right-0';
    }

    return 'origin-top';
});
</script>

<template>
    <div class="relative">
        <div @click="open = ! open">
            <slot name="trigger" />
        </div>

            <div
                v-show="open"
                class="px-6 z-50 mt-2 "
                :class="[widthClass, alignmentClasses]"
                style="display: none;"
                @click="open = false"
            >
                <div class="space-y-1 border-0 border-l border-dashed border-gray-600 ltr:pl-1 rtl:pr-1" :class="contentClasses">
                    <slot name="content" />
                </div>
            </div>
    </div>
</template>
