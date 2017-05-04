import * as _ from 'lodash'
import defaultNote from './defaults/note'

export const setNotes = (state, notes) => {
    state.notes = notes
}

export const setNote = (state, note) => {
    state.note = note
}

export const updateNote = (state, note) => {
    // Merge in the note object properties we're passing in
    // with the current open note state.
    state.note = { ...state.note, ...note }
}

export const removeNote = (state, noteId) => {
    state.notes = state.notes.filter((n) => {
        return n.id !== noteId
    })
}

export const appendToNotes = (state, note) => {
    var existing = state.notes.find((n) => {
        return n.id === state.note.id
    })

    if (existing) {
        // Assign the property values from the note we're updating
        // to the existing note inside the notes list.
        Object.assign(existing, note)
        return
    }

    state.notes.push(note)
}

export const clearNote = (state, note) => {
    state.note = _.clone(defaultNote)
}
