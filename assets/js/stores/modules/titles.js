import titlesApi from '@/api/titles'


const state = {
    error : null,
    hasError : false,
    titles : null,
    title : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    title(state){
        return state.title
    },
    titles(state){
        return state.titles
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.hasError = true
        state.title = null
        state.titles = null
    },

    getTitles(state, payload){
        state.error = null
        state.hasError = false
        state.title = null
        state.titles = payload
    },

    getTitle(state, payload){
        state.error = null
        state.hasError = false
        state.title = payload
        state.titles = null
    },
    setTitle(state,payload){
        state.error = null
        state.hasError = false
        state.title = payload
        state.titles = null
    },
}

const actions = {
    fetchTitles : (async ({commit}) => {
        let {data} = await titlesApi.getAll();
        commit('getTitles', data);
    }),
    fetchTitle : (async ({commit},payload) => {
        let {data} = await titlesApi.get(payload);
        commit('getTitle', data);
    }),
    createTitle : (async ({commit}, payload) => {
        try {
            const response = await titlesApi.create(payload);
            commit('setTitle', response.data);
        } catch (e){
            commit('setHasError', e.response.data.detail);
        }
    }),
    createLinkCVTitle : (async ({commit}, payload)=>{
        await titlesApi.linkCvTitle(payload);
    }),
    editTitle : (async ({commit}, payload)=>{
        try {
            const response = await titlesApi.edit(payload);
            commit('setTitle', response.data);
        } catch (e){
            commit('setHasError', e);
        }
    }),
    deleteTitle : (async ({commit},payload)=>{
        try{
            await titlesApi.delete(payload);
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
