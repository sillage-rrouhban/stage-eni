import birthdatesApi from "@/api/birthdates";

const state = {
    error : null,
    hasError : false,
    birthdates : null,
    birthdate : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    birthdate(state){
        return state.birthdate
    },
    birthdates(state){
        return state.birthdates
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.birthdate = null
        state.birthdates = null
    },

    getBirthdates(state, payload){
        state.error = null
        state.HasError = false
        state.birthdate = null
        state.birthdates = payload
    },

    getBirthdate(state, payload){
        state.error = null
        state.HasError = false
        state.birthdate = payload
        state.birthdates = null
    },
    setBirthdate(state,payload){
        state.error = null
        state.HasError = false
        state.birthdate = payload
        state.birthdates = null
    },
}

const actions = {
    fetchBirthdates : (async ({commit}) => {
        let {data} = await birthdatesApi.getAll();
        commit('getBirthdays', data);
    }),
    fetchBirthdate: async ({commit}, payload) => {
        let { data } = await birthdatesApi.get(payload);
        commit("getBirthdate", data);
    },
    createBirthdate : (async ({state, commit}, payload)=>{
        try {
            const response = await birthdatesApi.create(payload);
            commit('setBirthdate', response.data);
        } catch (e){
            commit('setHasError', e.response.data.detail);
        }
    }),
    editBirthdate : (async ({state, commit}, payload)=>{
        try {
            const iri  = '/api/birthdates/' + payload.id;
            const response = await birthdatesApi.edit(iri,payload);
            commit('setBirthdate', response.data);
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
