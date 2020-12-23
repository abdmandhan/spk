import ApiService from './../api.service';
import TokenService from './../token.service';

// action types
export const VERIFY_AUTH = "verifyAuth";
export const LOGIN = "login";
export const LOGOUT = "logout";
export const ERROR = "setErr";
export const MESSAGE = "message";

// mutation types
export const PURGE_AUTH = "logOut";
export const SET_AUTH = "setUser";
export const SET_ERROR = "setError";

const state = {
    errors: null,
    user: {},
    isAuthenticated: !!TokenService.getToken(),
};

const getters = {
    currentUser(state) {
        return state.user;
    },
    isAuthenticated(state) {
        return state.isAuthenticated;
    },
    errors(state) {
        return state.errors;
    },
};

const actions = {
    [LOGIN](context, credentials) {
        return new Promise(resolve => {
            ApiService.post("api/login", credentials)
                .then(({ data }) => {
                    console.log("credentials", credentials);
                    console.log("Here what post returns", data);
                    if (data.status) {
                        context.commit(SET_AUTH, data);
                        resolve(data);
                    } else {
                        context.commit(SET_ERROR, response.data.errors);
                    }
                })
                .catch(({ data }) => {
                    // console.log("response error", data)
                    // context.commit(SET_ERROR, response.data.errors);
                });

        });
    },
    [LOGOUT](context) {
        context.commit(PURGE_AUTH);
    },
    [ERROR](context, error) {
        context.commit('showMessage', { content: error, color: "red" }, { root: true });
        context.commit(SET_ERROR, error);
    },
    [MESSAGE](context, { message, color }) {
        context.commit('showMessage', { content: message, color: color }, { root: true });
    },
    [VERIFY_AUTH](context) {
        if (TokenService.getToken() && TokenService.getToken() !== "undefined") {
            ApiService.get("api/verify")
                .then(({ data }) => {
                    context.commit(SET_AUTH, data);
                })
                .catch(({ response }) => {
                    context.commit(SET_ERROR, response.data.errors);
                });
        } else {
            context.commit(PURGE_AUTH);
        }
    },
};

const mutations = {
    [SET_ERROR](state, error) {
        state.errors = error;
    },
    [SET_AUTH](state, user) {
        state.isAuthenticated = true;
        state.user = user.data.user;
        state.errors = {};
        TokenService.saveToken(user.data.token);
        // console.log("state", user);
    },
    [PURGE_AUTH](state) {
        state.isAuthenticated = false;
        state.user = {};
        state.errors = {};
        TokenService.destroyToken();
    }
};

export default {
    state,
    actions,
    mutations,
    getters
};
