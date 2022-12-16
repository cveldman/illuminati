<script setup>

import { Link } from '@inertiajs/inertia-vue3'
import Avatar from "@/Components/Avatar.vue";

defineProps({
    users: Array
})

</script>

<template>
    <Link href="/users/create">Create</Link>

    <div v-for="user in users" :key="user.id" class="flex">
        <Avatar/>
        <Link :href="'/users/' + user.id" class="flex-grow">
            {{ user.name }}
        </Link>
        <div class="flex">
            <Link :href="'/users/' + user.id + '/edit'">
                Edit
            </Link>
            <Link :href="'/users/' + user.id" method="delete" as="button" type="button">
                Delete
            </Link>
        </div>
    </div>
</template>
