<template>
    <v-container>
        <v-layout>
            <v-flex xs6>
                Columna 1
            </v-flex>
            <v-flex>
                Columna 2
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
export default {
    props: {
        posts: {
            type: Array,
            required: true
        }
    }
}
</script>

