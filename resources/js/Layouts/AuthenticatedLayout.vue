<template xmlns="http://www.w3.org/1999/html">
    <v-app>
        <v-app-bar color="accent" density="compact" elevation="1">
            <v-app-bar-title>Companies House</v-app-bar-title>
            <template v-slot:append>
                <v-btn text @click="this.$inertia.visit(route('profile.index'))">{{ user.name }}</v-btn>
                <v-btn
                    text
                    @click="logout"
                >Logout</v-btn>
            </template>
        </v-app-bar>
        <v-navigation-drawer permanent color="accent">
            <template v-slot:prepend>
                <v-list-item
                    lines="two"
                    :prepend-avatar="user.avatar"
                    :title="user.name"
                    subtitle="Logged in"
                ></v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list density="compact" nav>
                <v-list-item @click="this.$inertia.visit(route('dashboard'))" prepend-icon="mdi-home-city" title="Home" value="home"></v-list-item>
                <v-list-item @click="this.$inertia.visit(route('search.index'))" prepend-icon="mdi-magnify" title="Search" value="search"></v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { router } from '@inertiajs/vue3';

const user = computed(() => usePage().props.auth.user);

const logout = () => {
  router.get(route('logout'));
};
</script>
