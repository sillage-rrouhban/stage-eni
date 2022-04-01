import cvTitlesApi from '@/api/cvTitles'


const state = {
    error : null,
    hasError : false,
    cvTitles : null,
    cvTitle : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    cvTitle(state){
        return state.cvTitle
    },
    cvTitles(state){
        return state.cvTitles
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.hasError = true
        state.cvTitle = null
        state.cvTitles = null
    },

    getCvTitles(state, payload){
        state.error = null
        state.hasError = false
        state.cvTitle = null
        state.cvTitles = payload
    },

    getCvTitle(state, payload){
        state.error = null
        state.hasError = false
        state.cvTitle = payload
        state.cvTitles = null
    },

    setCvTitle(state,payload){
        state.error = null
        state.hasError = false
        state.cvTitle = payload
        state.cvTitles = null
    },
}

const actions = {
    fetchCvTitles : (async ({commit}) => {
        let {data} = await cvTitlesApi.getAll();
        commit('getCvTitles', data);
    }),
    fetchCvTitle : (async ({commit},payload) => {
        let {data} = await cvTitlesApi.get(payload);
        commit('getCvTitle', data);
    }),
    createCvTitle : (async ({commit}, payload)=>{
        try {
            const response = await cvTitlesApi.create(payload);
            commit('setCvTitle', response.data);
        } catch (e){
            commit('setHasError', e.response.data.detail);

        }
    }),
    editCvTitle : (async ({commit}, payload)=>{
        try {
            const response = await cvTitlesApi.edit(payload);
            commit('setCvTitle', response.data);
        } catch (e){
            commit('setHasError', e);
        }
    }),
    deleteCvTitle : (async ({commit},payload)=>{
        try{
            await cvTitlesApi.delete(payload);
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
