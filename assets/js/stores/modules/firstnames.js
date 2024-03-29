import firstnamesApi from '@/api/firstnames'

const state = {
    error : null,
    hasError : false,
    firstnames : null,
    firstname : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    firstname(state){
        return state.firstname
    },
    firstnames(state){
        return state.firstnames
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.firstname = null
        state.firstnames = null
    },

    getFirstnames(state, payload){
        state.error = null
        state.HasError = false
        state.firstname = null
        state.firstnames = payload
    },

    getFirstname(state, payload){
        state.error = null
        state.HasError = false
        state.firstname = payload
        state.firstnames = null
    },

    setFirstname(state,payload){
        state.error = null
        state.HasError = false
        state.firstname = payload
        state.firstnames = null
    },
}

const actions = {
    fetchFirstnames : (async ({commit}) => {
        let { data } = await firstnamesApi.getAll();
        commit('getFirstnames', data);
    }),
    fetchFirstname: async ({commit}, payload) => {
        let { data } = await firstnamesApi.get(payload);
        commit("getFirstname", data);
    },
    createFirstname : (async ({state, commit}, payload)=>{
        try {
            const { data } = await firstnamesApi.create(payload);
            commit('setFirstname', data);
        } catch (e){
            commit('setHasError', e);
        }
    }),
    editFirstname : (async ({state, commit}, payload)=>{
        try {
            const iri  = '/api/firstnames/' + payload.id;
            const response = await firstnamesApi.edit(iri,payload);
            commit('setFirstname', response.data);
        } catch (e){
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
