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
    fetchUser : (async ({commit},payload) => {
        let {data} = await usersApi.get(payload);
        commit('getUser', data);
    }),
    createUser : (async ({commit}, payload)=>{
        try {
            const response = await usersApi.create(payload);
            commit('setUser', response.data);
        } catch (e){
            commit('setHasError', e);

        }
    }),
    editUser : (async ({commit}, payload)=>{
        try {
            const response = await usersApi.edit(payload);
            commit('setUser', response.data);
        } catch (e){
            commit('setHasError', e);
        }
    }),
    deleteUser : (async ({commit},payload)=>{
        try{
            await usersApi.delete(payload);
        }catch(e) {
            commit('setHasError', e);
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
