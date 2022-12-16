<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
    projects: Array
})
</script>

<template>
    <Link href="/projects/create">Create</Link>

    <div v-for="project in projects" :key="project.id" class="flex">
        <Link :href="'/projects/' + project.id" class="flex-grow">
            {{ project.name }}
        </Link>
        <div>
            <Link :href="'/projects/' + project.id + '/edit'">
                Edit
            </Link>
            <Link :href="'/projects/' + project.id" method="delete" as="button" type="button">
                Delete
            </Link>
        </div>
    </div>
</template>
