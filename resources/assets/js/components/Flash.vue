<template>
    <div class="alert alert-info" v-if="flash">
        {{ flash }}
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                flash: 'flash'
            })
        }
    }
</script>
