import * as _ from 'lodash'

export const loadNotes = ({ commit }) => {
    return axios.get('/notes').then((response) => {
        commit('setNotes', response.data)
    })
}

export const loadNote = ({ commit }, noteId) => {
    return axios.get(`/notes/${noteId}`).then((response) => {
        // Destructure the response data and set rhe current note
        // with only the information that we need.
        let { id, title, body } = response.data
        commit('setNote', { id, title, body })
    })
}

export const newNote = ({ commit, dispatch, state }) => {
    // There's no need to create a 'new note' if the current note
    // had no content.
    if (_.isEmpty(state.note.title) && _.isEmpty(state.note.body)) {
        return
    }

    // Save the current note before we clear out and create
    // a new note!
    dispatch('saveNote', false).then(() => {
        commit('clearNote')
    })
    dispatch('flash', 'A fresh note has been created.')
}

export const saveNote = ({ commit, dispatch, state }, flashForUpdate = true) => {
    let existing = state.notes.find((n) => {
        return n.id === state.note.id
    })

    // Just patch the note if it already exists.
    if (existing) {
        return axios.patch(`/notes/${state.note.id}`, state.note).then((response) => {
            commit('appendToNotes', response.data)
            if (flashForUpdate) {
                dispatch('flash', 'Your note has been saved.')
            }
        })
    }

    // Otherwise create a new note, fill it with the ID from our
    // backend, and then append to the notes list.
    return axios.post('/notes', state.note).then((response) => {
        commit('updateNote', { id: response.data.id })
        commit('appendToNotes', response.data)
        dispatch('flash', 'Your new note has been saved.')
    })
}

export const deleteNote = ({ commit, dispatch, state }, noteId) => {
    return axios.delete(`/notes/${noteId}`).then((response) => {
        commit('removeNote', noteId)
        dispatch('flash', 'Your note has been deleted.')

        // If the current note we're viewing is the note we're
        // deleting, the clear the note area.
        if (state.note.id === noteId) {
            commit('clearNote')
        }
    })
}
