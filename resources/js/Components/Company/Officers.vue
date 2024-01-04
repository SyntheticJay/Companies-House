<template>
    <v-card>
        <v-card-title>Officers</v-card-title>
        <v-card-text>
            <v-table>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Appointed On</th>
                        <th scope="col">Nationality</th>
                        <th scope="col">Occupation</th>
                        <th scope="col">Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="officer in officers" :key="officer.id">
                        <td>{{ officer.name }}</td>
                        <td>{{ $filters.prettyDate(officer.appointed_on, 'DD/MM/YYYY')}}</td>
                        <td>{{ officer.nationality }}</td>
                        <td>{{ officer.occupation }}</td>
                        <td>{{ officer.officer_role }}</td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>
</template>

<script setup>
defineProps({
    officers: {
        type: Object,
        required: true
    }
});
</script>
