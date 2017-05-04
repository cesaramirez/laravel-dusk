<template>
    <div class="uk-card uk-card-default uk-card-hover">
        <div class="uk-card-header">
            <div class="uk-card-title">
                {{ note.title || 'Untitled' }}
            </div>
            <div class="uk-card-body uk-padding-remove-horizontal">
                <div class="uk-margin">
                    <input  class="uk-input"
                            placeholder="Note Title"
                            v-model="title"
                            id="title">
                </div>
                <textarea class="uk-textarea"
                          rows="6"
                          v-model="body"
                          id="body"
                          placeholder="Your Notes">
                </textarea>
                <p>Word count: {{ noteWordCount }}</p>
            </div>
            <div class="uk-card-footer uk-padding-remove-horizontal">
                <button type="submit"
                        class="uk-button uk-button-primary uk-width-1-1" @click.prevent="saveNote">Save
                </button>
            </div>
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
