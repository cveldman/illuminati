<template>
    <input
        type="text"
        ref="input"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
    />
</template>

<script setup>

import { ref, onMounted } from 'vue'

defineProps(['modelValue'])
defineEmits(['update:modelValue'])

const input = ref(null)

defineExpose({ input });

</script>
