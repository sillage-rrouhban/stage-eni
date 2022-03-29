import zipcodesApi from "@/api/Zipcodes";

const state = {
    error : null,
    hasError : false,
    zipcodes : null,
    zipcode : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    zipcode(state){
        return state.zipcode
    },
    zipcodes(state){
        return state.zipcodes
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.zipcode = null
        state.zipcodes = null
    },

    getZipcodes(state, payload){
        state.error = null
        state.HasError = false
        state.zipcode = null
        state.zipcodes = payload
    },

    getZipcode(state, payload){
        state.error = null
        state.HasError = false
        state.zipcode = payload
        state.zipcodes = null
    },
}

const actions = {
    fetchZipcodes : (async ({commit}) => {
        let {data} = await zipcodesApi.getAll();
        commit('getZipcodes', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}