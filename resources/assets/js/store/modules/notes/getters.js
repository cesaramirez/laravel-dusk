import * as _ from 'lodash'

export const note = (state) => {
    return state.note
}

export const notes = (state) => {
    // Sort the notes in descending order from when they
    // were last updated.
    return state.notes.sort((a, b) => {
        return b['updatedAtTimestamp'] - a['updatedAtTimestamp']
    })
}

export const notesCount = (state) => {
    return state.notes.length
}

export const noteWordCount = (state) => {
    if (_.isEmpty(state.note.body) || _.isEmpty(state.note.body.trim())) {
        return 0;
    }

    return state.note.body.trim().split(' ').length
}
