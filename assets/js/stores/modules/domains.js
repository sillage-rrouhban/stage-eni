import domainsApi from '@/api/domains'

const state = {
    error : null,
    hasError : false,
    domains : null,
    domain : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    domain(state){
        return state.domain
    },
    domains(state){
        return state.domains
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.domain = null
        state.domains = null
    },

    getDomains(state, payload){
        state.error = null
        state.HasError = false
        state.domain = null
        state.domains = payload
    },

    getDomain(state, payload){
        state.error = null
        state.HasError = false
        state.domain = payload
        state.domains = null
    },
}

const actions = {
    fetchDomains : (async ({commit}) => {
        let {data} = await domainsApi.getAll();
        commit('getDomains', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}