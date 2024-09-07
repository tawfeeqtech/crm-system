<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// import TextInput from '@/Components/TextInput.vue';
// import VueSelect from "vue3-select-component";

import InputText from 'primevue/inputtext';
import DatePicker from 'primevue/datepicker';
import Select from 'primevue/select';
import Textarea from 'primevue/textarea';

import { ref, watch } from 'vue';

const props = defineProps({
    users: Array,
    clients: Array,
    statusOptions: Array, // Receiving statusOptions from the controller as an object
});

const form = useForm({
    title: '',
    slug: '',
    body: '',
    deadline: '',
    status: '',
    user_id: '',
    client_id: '',
});


watch(() => form.title, (newTitle) => {
    form.slug = newTitle
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/^-+|-+$/g, '');
});


</script>

<template>

    <Head title="Create New Project" />

    <AdminLayout>
        <div class="py-4 mx-auto max-w-7xl">
            <div class="flex justify-between">
                <Link class="px-3 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-700"
                    :href="route('projects.index')">
                back
                </Link>
            </div>
            <div class="max-w-6xl p-6 mx-auto mt-6 rounded-lg shadow-lg bg-slate-100">
                <h1 class="text-2xl font-semibold text-indigo-700">Create New Project</h1>
                <form @submit.prevent="form.post(route('projects.store'))">

                    <div class="flex items-center mt-4">
                        <!-- Title Input -->
                        <div class="flex-1 mr-2">
                            <!-- <InputLabel for="title" value="Title" />
                            <TextInput id="title" type="text" class="block w-full mt-1" v-model="form.title"
                                autofocus /> -->
                            <label for="title" class="block mb-2 font-bold"> Title </label>

                            <InputText type="text" class="block w-full mt-1" v-model="form.title" inputId="title" />

                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <!-- Slug Input -->
                        <div class="flex-1 ml-2">
                            <!-- <InputLabel for="slug" value="Slug" />
                            <TextInput id="slug" type="text" class="block w-full mt-1" v-model="form.slug" disabled /> -->
                            <label for="slug" class="block mb-2 font-bold"> Slug </label>

                            <InputText type="text" class="block w-full mt-1" v-model="form.slug" disabled
                                inputId="slug" />

                            <InputError class="mt-2" :message="form.errors.slug" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <!-- <label for="body">Body</label> -->
                        <label for="status" class="block mb-2 font-bold"> Description </label>

                        <Textarea v-model="form.body" inputId="status"
                            class="w-full px-3 py-2 border border-gray-300 border-solid rounded-md resize-none dark:bg-gray-900 dark:border-none focus:outline-none "
                            rows="5" cols="30" />

                        <!-- <textarea id="body" v-model="form.body" name="body"
                            class="w-full px-3 py-2 border border-gray-300 border-solid rounded-md resize-none dark:bg-gray-900 dark:border-none focus:outline-none "
                            placeholder="Type Body...*" rows="5" required></textarea> -->
                    </div>


                    <div class="flex items-center mt-4">
                        <!-- Title Input -->
                        <div class="flex-1 mr-2">
                            <label for="deadline" class="block mb-2 font-bold"> Deadline </label>
                            <DatePicker v-model="form.deadline" showIcon fluid iconDisplay="input" inputId="deadline" />
                            <InputError class="mt-2" :message="form.errors.deadline" />
                        </div>

                        <div class="flex-1 mr-2">
                            <label for="user" class="block mb-2 font-bold"> Assigned user </label>
                            <Select v-model="form.user_id" :options="users" optionLabel="label" inputId="user"
                                class="w-full" />

                            <InputError class="mt-2" :message="form.errors.user" />
                        </div>

                        <div class="flex-1 mr-2">
                            <label for="client" class="block mb-2 font-bold"> Assigned client </label>
                            <Select v-model="form.client" :options="clients" optionLabel="label" inputId="client"
                                class="w-full" />

                            <InputError class="mt-2" :message="form.errors.client" />
                        </div>

                        <!-- Status Input -->
                        <div class="flex-1 ml-2">

                            <label for="status" class="block mb-2 font-bold"> Status </label>
                            <Select v-model="form.status" :options="statusOptions" optionLabel="label"
                                placeholder="Status" inputId="status" class="w-full" />

                            <!-- <InputLabel for="status" value="Status" /> -->
                            <!-- <VueSelect v-model="form.status" :options="statusOptions" :close-on-select="true" /> -->
                            <InputError class="mt-2" :message="form.errors.status" />

                        </div>
                    </div>

                    <div class="flex items-center mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
