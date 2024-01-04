<template>
    <AuthenticatedLayout>
       <v-container>
           <v-card>
               <v-card-title>Monitor</v-card-title>
               <v-card-text>

               </v-card-text>
           </v-card>
       </v-container>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";

defineProps({
    monitors: {
        type: Object,
        required: true
    }
})
</script>
