<template>
    <div class="notes">
        <div v-if="notes.length">
            <ul class="list-group">
                <li class="list-group-item">You have {{ notesCount }} {{ pluralize('note', notesCount) }}</li>
                <li class="list-group-item" v-for="note in notes">
                    <a href="#" @click.prevent="loadNote(note.id)">{{ note.title }}</a>
                    <a href="#" @click.prevent="deleteNote(note.id)">Delete</a>
                </li>
            </ul>

            <a href="#" @click.prevent="newNote">Create new note</a>
        </div>
        <p v-else>No notes yet</p>
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

<style>
    .list-group-item {
        display: flex;
        justify-content: space-between;
    }
</style>
