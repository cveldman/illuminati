<script setup>

import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps({
    project: Object
})

const form = useForm({
    name: props.project.name
});

</script>

<template>
    <form @submit.prevent="form.put('/projects/' + props.project.id)">
        <input type="text" v-model="form.name"/>
        <button type="submit">Save</button>
    </form>
</template>
