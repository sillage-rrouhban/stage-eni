import levelsApi from '@/api/levels'

const state = {
    error : null,
    hasError : false,
    levels : null,
    level : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    level(state){
        return state.level
    },
    levels(state){
        return state.levels
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.level = null
        state.levels = null
    },

    getLevels(state, payload){
        state.error = null
        state.HasError = null
        state.level = null
        state.levels = payload
    },

    getLevel(state, payload){
        state.error = null
        state.HasError = null
        state.level = payload
        state.levels = null
    },
}

const actions = {
    fetchLevels : (async ({commit}) => {
        let {data} = await levelsApi.getAll();
        commit('getLevels', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}