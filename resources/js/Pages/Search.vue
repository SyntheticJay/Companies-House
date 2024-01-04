<template>
    <AuthenticatedLayout>
        <v-container>
            <v-card>
                <v-form @submit.prevent="form.post(route('search.submit'))">
                    <v-card-text>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    v-model="form.query"
                                    :error="form.errors.query"
                                    :error-messages="form.errors.query"
                                    label="Search"
                                    name="query"
                                    outlined
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary">
                            <v-icon left>mdi-magnify</v-icon>
                        </v-btn>
                    </v-card-text>
                </v-form>
            </v-card>

            <template v-if="companies.length > 0">
                <v-table class="mt-1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Number</th>
                            <th>Locality</th>
                            <th>Date of Creation</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="company in companies" :key="company.id">
                            <td>{{ company.title }}</td>
                            <td>
                                <v-chip
                                    :color="company.company_status === 'active' ? 'green' : 'red'"
                                    text-color="white"
                                >{{ company.company_status }}</v-chip>
                            </td>
                            <td>{{ company.company_number }}</td>
                            <td>{{ company.address.locality }}</td>
                            <td>{{ $filters.prettyDate(company.date_of_creation, 'DD/MM/YYYY') }}</td>
                            <td class="text-end">
                                <v-btn @click="this.$inertia.visit(route('companies.index', company.company_number))" color="secondary" text>
                                    <v-icon>mdi-eye</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
            </template>
        </v-container>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";

defineProps({
    companies: {
        type: Array,
        default: () => [],
        required: false
    },
});

const form = useForm({
    query: "",
});
</script>
