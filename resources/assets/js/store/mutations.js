export const setFlash = (state, message) => {
    state.flash = message
}

export const clearFlash = (state) => {
    state.flash = null
}
