<template>
    <v-app>
        <v-container>
            <div class="d-flex justify-center align-center vh-100">
                <v-card variant="elevated" width="400">
                    <v-toolbar color="primary" dark flat>
                        <v-toolbar-title>Login</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form @submit.prevent="submit">
                            <v-text-field
                                v-model="form.email"
                                :error="errors.email"
                                label="Email"
                                name="email"
                                type="email"
                            ></v-text-field>
                            <v-text-field
                                v-model="form.password"
                                :error="errors.password"
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
                        <template v-if="errors.email">
                            <v-alert type="error" dismissible>
                                {{ errors.email }}
                            </v-alert>
                        </template>
                    </v-card-text>
                </v-card>
            </div>
        </v-container>
    </v-app>
</template>
<script setup>
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

defineProps({
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const form = reactive({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    router.post(route('auth.authenticate'), form);
};
</script>
