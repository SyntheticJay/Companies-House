<template>
    <AuthenticatedLayout>
        <v-container fluid>
            <General
                :company="company"
                v-if="currentlySelected === 'general'"
            />
            <FilingHistory
                :filing-history="company.filing_history"
                v-if="currentlySelected === 'filing-history'"
            />
            <PreviousNames
                :previous-names="company.previous_company_names"
                v-if="currentlySelected === 'previous-names'"
            />
            <Officers
                :officers="company.officers"
                v-if="currentlySelected === 'officers'"
            />
            <Accounts
                :company="company"
                v-if="currentlySelected === 'accounts'"
            />
            <v-bottom-navigation v-model="currentlySelected">
                <v-btn value="general">
                    <v-icon>mdi-home</v-icon>
                    <span>General</span>
                </v-btn>
                <v-btn value="filing-history">
                    <v-icon>mdi-file-document</v-icon>
                    <span>Filing History</span>
                </v-btn>
                <v-btn value="previous-names" v-if="company.previous_company_names">
                    <v-icon>mdi-file-document</v-icon>
                    <span>Previous Names</span>
                </v-btn>
                <v-btn value="officers">
                    <v-icon>mdi-account-group</v-icon>
                    <span>Officers</span>
                </v-btn>
                <v-btn value="accounts">
                    <v-icon>mdi-file-document-multiple</v-icon>
                    <span>Accounts</span>
                </v-btn>
            </v-bottom-navigation>
        </v-container>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";

import AuthenticatedLayout from "../Layouts/AuthenticatedLayout.vue";
import Officers from "../Components/Company/Officers.vue";
import General from "../Components/Company/General.vue";
import PreviousNames from "../Components/Company/PreviousNames.vue";
import Accounts from "../Components/Company/Accounts.vue";
import FilingHistory from "../Components/Company/FilingHistory.vue";

defineProps({
    company: {
        type: Object,
        default: () => [],
        required: false
    }
});

const currentlySelected = ref("general");
</script>
