import securityApi from "@/api/security";

let timer;

const state = {
    autoLogout: false, //check token is not expire
    error: null,
    hasError: false,
    token: null,
    user: null, //stock IRI user
}

const getters = {
    autoLogout(state) {
        return state.autoLogout
    },
    error(state) {
        return state.error
    },
    hasError(state) {
        return state.hasError
    },
    token(state) {
        return state.token
    },
    user(state) {
        return state.user
    },
    isAuthenticated(state){
        return !!state.token
    }


}

const mutations = {
    setHasError(state, payload) {
        state.autoLogout = false
        state.error = payload
        state.HasError = true
        state.token = null
        state.user = null
    },

    setUser(state, payload) {
        state.autoLogout = false;
        state.error = false;
        state.hasError = false;
        state.token = payload.token;
        state.user = payload.user;
    },

    setLogout(state) {
        state.autoLogout = false;
        state.error = null;
        state.HasError = false;
        state.token = null;
        state.user = null;
    },

    setAutoLogout(state) {
        state.autoLogout = true;
        state.error = null;
        state.HasError = false;
        state.token = null;
        state.user = null;
    },
    setAuthSuccess(state, payload) {
        state.autoLogout = false;
        state.error = null;
        state.HasError = false;
        state.token = null;
        state.user = null;
    }
}

const actions = {
    login: (async ({commit, dispatch}, payload) => {
        try {
            const authResponse = await securityApi.login(payload);
            let token = authResponse.data.token;
            localStorage.setItem('token', token);
            commit('setAuthSuccess', authResponse.data);
            await dispatch('fetchUser', {token: token});
        } catch (e) {
            commit('setHasError', e);
        }

    }),

    fetchUser: (async ({commit, dispatch}, payload) => {
        try {
            const userResponse = await securityApi.fetchUser(payload.token);
            commit('setUser', {
                token: payload.token,
                user: '/api/users/' + userResponse.data.id,
            })
            const expirationDate = userResponse.data.tokenExp * 1000;
            localStorage.setItem('expiration', expirationDate);
            localStorage.setItem('email', userResponse.data.email);
            localStorage.setItem('user', '/api/users/' + userResponse.data.id);
            localStorage.setItem('type', userResponse.data.typeId);
            const expiresIn = expirationDate - new Date();
            timer = setTimeout(() => {
                dispatch('autoLogout');
            }, expiresIn)

        } catch (e) {
            commit('setHasError', e);
        }

    }),

    tryLogin: (async ({commit, dispatch}) => {
        const token = localStorage.getItem('token');
        const expiration = localStorage.getItem('expiration' );
        const email = localStorage.getItem('email');
        const user = localStorage.getItem('user');
        const type = localStorage.getItem('type');
        const expiresIn = +expiration  - new Date();
        if (expiresIn < 0) return;
         timer = setTimeout(() => {
             dispatch('autoLogout');
         }, expiresIn)
       if (token && expiration && email && user && type) {
            commit('setUser', {
                token: token,
                user: user
            })
        }
    }),

    logout: (({commit}) => {
        localStorage.removeItem('token');
        localStorage.removeItem('expiration');
        localStorage.removeItem('email');
        localStorage.removeItem('user');
        localStorage.removeItem('type');
        clearTimeout(timer);
        commit('setUser', {
            token: null,
            user: null
        })
    }),

    autoLogout({commit, dispatch}) {
        dispatch('logout');
        commit('setAutoLogout');
    }

}


export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}