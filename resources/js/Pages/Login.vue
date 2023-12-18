<template>
    <v-app>
        <v-container>
            <div class="d-flex justify-center align-center vh-100">
                <v-card variant="elevated" width="400">
                    <v-toolbar color="accent" dark flat>
                        <v-toolbar-title>Login</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form @submit.prevent="form.post(route('auth.authenticate'))">
                            <v-text-field
                                v-model="form.email"
                                :error="form.errors.email"
                                :error-messages="form.errors.email"
                                label="Email"
                                name="email"
                                type="email"
                                class="mb-2"
                            ></v-text-field>
                            <v-text-field
                                v-model="form.password"
                                label="Password"
                                name="password"
                                type="password"
                            ></v-text-field>
                            <v-checkbox
                                v-model="form.remember"
                                label="Remember me"
                                name="remember"
                            ></v-checkbox>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="primary" type="submit">Login</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card-text>
                </v-card>
            </div>
        </v-container>
    </v-app>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});
</script>
