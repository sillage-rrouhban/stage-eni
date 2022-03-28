import usersApi from '@/api/users'

const state = {
    error : null,
    hasError : false,
    users : null,
    user : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    user(state){
        return state.user
    },
    users(state){
        return state.users
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.user = null
        state.users = null
    },

    getUsers(state, payload){
        state.error = null
        state.HasError = false
        state.user = null
        state.users = payload
    },

    getUser(state, payload){
        state.error = null
        state.HasError = false
        state.user = payload
        state.users = null
    },

    setUser(state,payload){
        state.error = null
        state.HasError = false
        state.user = payload
        state.users = null
    },
}

const actions = {
    fetchUsers : (async ({commit}) => {
        let {data} = await usersApi.getAll();
        commit('getUsers', data);
    }),
    createUser : (async ({state, commit}, payload)=>{
        try {
            const response = await usersApi.create(payload);
            commit('setUser', response.data);
        } catch (e){
            console.log(e.response.data.detail);
            //commit('setHasError', e.response.data())
        }

    }),

}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}