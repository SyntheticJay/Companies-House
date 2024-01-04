<template>
    <v-card>
        <v-card-title>Previous Names</v-card-title>
        <v-table>
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Effective From</th>
                    <th scope="col">Ceased On</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="name in previousNames" :key="name.id">
                    <td>{{ name.name }}</td>
                    <td>{{ $filters.prettyDate(name.effective_from, 'DD/MM/YYYY') }}</td>
                    <td>{{ $filters.prettyDate(name.ceased_on, 'DD/MM/YYYY') }}</td>
                </tr>
            </tbody>
        </v-table>
    </v-card>
</template>

<script setup>
defineProps({
    previousNames: {
        type: Array,
        default: () => [],
        required: false
    }
})
</script>
