import typesApi from '@/api/types'

const state = {
    error : null,
    hasError : false,
    types : null,
    type : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    type(state){
        return state.type
    },
    types(state){
        return state.types
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.type = null
        state.types = null
    },

    getTypes(state, payload){
        state.error = null
        state.HasError = null
        state.type = null
        state.types = payload
    },

    getType(state, payload){
        state.error = null
        state.HasError = null
        state.type = payload
        state.types = null
    },
}

const actions = {
    fetchTypes : (async ({commit}) => {
        let {data} = await typesApi.getAll();
        commit('getTypes', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}