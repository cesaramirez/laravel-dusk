<template>
    <div>
        <div v-if="notes.length">
            <ul class="uk-list uk-list-divider">
                <li>
                  <h4 class="uk-heading-line uk-text-center">
                      <span>
                        You have {{ notesCount }} {{ pluralize('note', notesCount) }}
                      </span>
                  </h4>
                </li>
                <li v-for="note in notes">
                    <a  class="uk-button"
                        href="#"
                        @click.prevent="loadNote(note.id)">
                        {{ note.title | truncate(15, '...') }}
                    </a>
                    <a  class="uk-button uk-button-danger uk-align-right"
                        href="#"
                        @click.prevent="deleteNote(note.id)">Delete
                      </a>
                </li>
            </ul>
            <hr>
            <a  class="uk-button uk-button-secondary uk-width-1-1"
                href='#'
                @click.prevent='newNote'>Create new note
            </a>
        </div>
        <h4 class="uk-heading-line uk-text-center" v-else>
            <span>
              No notes yet
            </span>
        </h4>
    </div>
</template>

<script>
    import pluralize from 'pluralize'
    import { mapGetters, mapActions } from 'vuex'

    export default {
        methods: {
            pluralize: pluralize,
            ...mapActions({
                loadNotes: 'loadNotes',
                loadNote: 'loadNote',
                newNote: 'newNote',
                deleteNote: 'deleteNote'
            })
        },
        computed: {
            ...mapGetters({
                notes: 'notes',
                notesCount: 'notesCount'
            })
        },
        mounted () {
            this.loadNotes()
        }
    }
</script>
