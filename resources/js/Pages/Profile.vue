<template>
    <AuthenticatedLayout>
        <v-container fluid>
            <v-row>
                <v-col cols="6">
                    <v-card>
                        <v-card-text>
                            <v-form @submit.prevent="form.post(route('profile.update'))">
                                <v-text-field
                                    v-model="form.name"
                                    :error="form.errors.name"
                                    :error-messages="form.errors.name"
                                    label="Name"
                                    name="name"
                                    type="text"
                                ></v-text-field>
                                <v-text-field
                                    v-model="form.email"
                                    :error="form.errors.email"
                                    :error-messages="form.errors.email"
                                    label="Email"
                                    name="email"
                                    type="email"
                                ></v-text-field>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="primary" @click="console.log('todo')">Forgot Password?</v-btn>
                                    <v-btn color="primary" type="submit">Update</v-btn>
                                </v-card-actions>
                            </v-form>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import { usePage, router, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

const user = computed(() => usePage().props.auth.user);

const form = useForm({
    name: user.value.name,
    email: user.value.email,
});
</script>
