const state = () => ({
    content: '',
    color: ''
})

const getters = {};

const actions = {};

const mutations = {
    showMessage(state, payload) {
        state.content = payload.content
        state.color = payload.color
    }
}

export default {
    state,
    actions,
    mutations,
    getters
};
