<template>
    <AuthenticatedLayout>
        <v-container>
            <h1>Welcome to Companies House, {{ $page.props.auth.user.name }}</h1>
        </v-container>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
</script>
