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
    }),
    createCity : (async ({state, commit}, payload)=>{
        try {
            const response = await citiesApi.create(payload);
            commit('setCity', response.data);
        } catch (e){
            commit('setHasError', e.response.data.detail);
        }
    }),
    editCity : (async ({state, commit}, payload)=>{
        try {
            const iri  = '/api/cities/' + payload.id;
            const response = await citiesApi.edit(iri,payload);
            commit('setCity', response.data);
        } catch (e){
            commit('setHasError', e.response.data.detail);
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