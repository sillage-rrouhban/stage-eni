import citiesApi from "@/api/cities";

const state = {
    error : null,
    hasError : false,
    cities : null,
    city : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    city(state){
        return state.city
    },
    cities(state){
        return state.cities
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.city = null
        state.cities = null
    },

    getCities(state, payload){
        state.error = null
        state.HasError = false
        state.city = null
        state.cities = payload
    },

    getCity(state, payload){
        state.error = null
        state.HasError = false
        state.city = payload
        state.cities = null
    },
}

const actions = {
    fetchCities : (async ({commit}) => {
        let {data} = await citiesApi.getAll();
        commit('getCities', data);
    })
}



export default{
    namespaced : true,
    state,
    getters,
    actions,
    mutations,
}