<template>
    <div v-if="flash">
        {{ noti(flash) }}
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                flash: 'flash'
            })
        },
        methods: {
          noti: function(flash) {
            UIkit.notification("<span uk-icon='icon: check'></span> " + flash, {status: 'success', timeout: 750});
          }

        }
    }
</script>
