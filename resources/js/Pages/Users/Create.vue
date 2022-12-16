<script setup>

import {useForm} from "@inertiajs/inertia-vue3";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Button from "@/Components/Button.vue";

const form = useForm({
    name: null,
    description: null
});

</script>

<template>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 p-4">
        <form @submit.prevent="form.post('/projects')" class="space-y-6">

            <div>
                <Label for="name">Name *</Label>
                <div class="mt-1">
                    <Input type="text" name="test" ref="test" v-model="form.name"/>
                </div>
                <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">
                    {{ form.errors.name }}
                </p>
            </div>

            <div>
                <Label for="description">Description</Label>
                <div class="mt-1">
                    <Input type="text" v-model="form.description"/>
                </div>
                <p v-if="form.errors.description" class="mt-2 text-sm text-red-600">
                    {{ form.errors.description }}
                </p>
            </div>

            <Button type="submit">Save</Button>
        </form>
    </div>
</template>
