export const flash = ({ commit }, message) => {
    commit('setFlash', message)

    setTimeout(() => {
        commit('clearFlash')
    }, 2000)
}
