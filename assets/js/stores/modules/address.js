import addressesApi from "@/api/addresses";

const state = {
    error : null,
    hasError : false,
    addresses : null,
    address : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    address(state){
        return state.address
    },
    addresses(state){
        return state.addresses
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.address = null
        state.addresses = null
    },

    getAddresses(state, payload){
        state.error = null
        state.HasError = false
        state.address = null
        state.addresses = payload
    },

    getCity(state, payload){
        state.error = null
        state.HasError = false
        state.address = payload
        state.addresses = null
    },
}

const actions = {
    fetchAddresses : (async ({commit}) => {
        let {data} = await addressesApi.getAll();
        commit('getAddresses', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}