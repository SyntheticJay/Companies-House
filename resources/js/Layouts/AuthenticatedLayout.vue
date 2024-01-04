<template xmlns="http://www.w3.org/1999/html">
    <v-app>
        <v-app-bar color="accent" density="compact" elevation="1">
            <template v-slot:prepend>
                <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            </template>
            <v-app-bar-title>Companies House</v-app-bar-title>
            <v-spacer />
            <template v-slot:append>
                <v-btn text @click="this.$inertia.visit(route('profile.index'))">{{ $page.props.auth.user.name }}</v-btn>
                <v-btn text @click="this.$inertia.visit(route('logout'))">Logout</v-btn>
                <v-btn text @click="toggleTheme">
                    <v-icon>{{ usingDark ? 'mdi-lightbulb' : 'mdi-lightbulb-off' }}</v-icon>
                </v-btn>
            </template>
        </v-app-bar>
        <v-navigation-drawer permanent color="accent" v-model="drawer">
            <template v-slot:prepend>
                <v-list-item
                    lines="two"
                    :prepend-avatar="$page.props.auth.user.avatar"
                    :title="$page.props.auth.user.name"
                    subtitle="Logged in"
                ></v-list-item>
            </template>
            <v-divider></v-divider>
            <v-list density="compact" nav>
                <v-list-item @click="this.$inertia.visit(route('dashboard'))" prepend-icon="mdi-home-city" title="Home" value="home"></v-list-item>
                <v-list-item @click="this.$inertia.visit(route('search.index'))" prepend-icon="mdi-magnify" title="Search" value="search"></v-list-item>
                <v-list-item @click="this.$inertia.visit(route('monitor.index'))" prepend-icon="mdi-monitor" title="Monitor" value="monitor"></v-list-item>
            </v-list>
        </v-navigation-drawer>
        <v-main>
            <slot />
        </v-main>
    </v-app>
</template>

<script setup>
import { computed, ref } from "vue";
import { useTheme } from 'vuetify';

const drawer = ref(true);
const theme = useTheme();
const usingDark = computed(() => theme.global.current.value.dark);

function toggleTheme () {
    theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
};
</script>
