<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import TextInput from '@/Components/TextInput.vue';

import VueSelect from "vue3-select-component";
import { defineProps } from 'vue';

const props = defineProps({
    client: { type: Object, required: true },
    statusOptions: Array, // Receiving statusOptions from the controller as an object
});

const form = useForm({
    company: props.client.company,
    vat: props.client.vat,
    address: props.client.address,
    status: props.client.status,
});

</script>

<template>

    <Head title="Update Client" />

    <AdminLayout>
        <div class="py-4 mx-auto max-w-7xl">
            <div class="flex justify-between">
                <Link class="px-3 py-2 font-semibold text-white bg-indigo-500 rounded hover:bg-indigo-700"
                    :href="route('clients.index')">
                back
                </Link>
            </div>
            <div class="max-w-6xl p-6 mx-auto mt-6 rounded-lg shadow-lg bg-slate-100">
                <h1 class="text-2xl font-semibold text-indigo-700">Create New Client</h1>
                <form @submit.prevent="form.put(route('clients.update', client))">
                    <div class="mt-4">
                        <InputLabel for="company" value="Company" />

                        <TextInput id="company" type="text" class="block w-full mt-1" v-model="form.company"
                            autofocus />

                        <InputError class="mt-2" :message="form.errors.company" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="vat" value="Vat" />

                        <TextInput id="vat" type="number" min="1" max="99999" class="block w-full mt-1"
                            v-model="form.vat" autofocus />

                        <InputError class="mt-2" :message="form.errors.vat" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="address" value="Address" />

                        <TextInput id="address" type="text" class="block w-full mt-1" v-model="form.address"
                            autofocus />

                        <InputError class="mt-2" :message="form.errors.address" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="status" value="Status" />
                        <VueSelect v-model="form.status" :options="statusOptions" :close-on-select="true" />
                        <InputError class="mt-2" :message="form.errors.status" />
                    </div>

                    <div class="flex items-center mt-4">
                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AdminLayout>
</template>
