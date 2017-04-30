<template>
    <div class="panel panel-default note">
        <div class="panel-heading">{{ note.title || 'Untitled' }}</div>

        <div class="panel-body">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Note title" v-model="title" id="title">
            </div>
            <div class="form-group">
                <textarea rows="10" class="form-control" placeholder="Your notes" v-model="body" id="body"></textarea>
            </div>

            <p>Word count: {{ noteWordCount }}</p>

            <button type="submit" class="btn btn-default" @click.prevent="saveNote">Save</button>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex'

    export default {
        methods: {
            ...mapActions({
                saveNote: 'saveNote'
            }),
            ...mapMutations({
                updateNote: 'updateNote'
            })
        },
        computed: {
            ...mapGetters({
                note: 'note',
                noteWordCount: 'noteWordCount'
            }),
            title: {
                set (value) {
                    this.updateNote({
                        title: value
                    })
                },
                get () {
                    return this.note.title
                }
            },
            body: {
                set (value) {
                    this.updateNote({
                        body: value
                    })
                },
                get () {
                    return this.note.body
                }
            }
        }
    }
</script>
