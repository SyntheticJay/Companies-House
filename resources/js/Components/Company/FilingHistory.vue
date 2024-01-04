<template>
    <v-card>
        <v-card-title>Filing History</v-card-title>
        <v-table>
            <thead>
                <tr>
                    <th scope="col">Action Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="filing in filingHistory">
                    <td>{{ $filters.prettyDate(filing.action_date, 'DD/MM/YYYY')}}</td>
                    <td>{{ filing.category }}</td>
                    <td>{{ $filters.prettyDate(filing.date, 'DD/MM/YYYY')}}</td>
                    <td>{{ filing.type }}</td>
                    <td class="text-end">
                        <v-btn
                            :href="filing.links.self"
                            target="_blank"
                            text
                            color="secondary"
                            small
                        >
                            <v-icon left>mdi-file-document</v-icon>
                        </v-btn>
                    </td>
                </tr>
            </tbody>
        </v-table>
    </v-card>
</template>

<script setup>
defineProps({
    filingHistory: {
        type: Array,
        default: () => [],
        required: false
    },
})
</script>
