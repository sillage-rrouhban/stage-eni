import LastnamesApi from '@/api/Lastnames'

const state = {
    error : null,
    hasError : false,
    Lastnames : null,
    Lastname : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    Lastname(state){
        return state.Lastname
    },
    Lastnames(state){
        return state.Lastnames
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.Lastname = null
        state.Lastnames = null
    },

    getLastnames(state, payload){
        state.error = null
        state.HasError = false
        state.Lastname = null
        state.Lastnames = payload
    },

    getLastname(state, payload){
        state.error = null
        state.HasError = false
        state.lastname = payload
        state.lastnames = null
    },

    setLastname(state,payload){
        state.error = null
        state.HasError = false
        state.Lastname = payload
        state.Lastnames = null
    },
}

const actions = {
    fetchLastnames : (async ({commit}) => {
        let {data} = await LastnamesApi.getAll();
        commit('getLastnames', data);
    }),
    createLastname : (async ({state, commit}, payload)=>{
        try {
            const response = await LastnamesApi.create(payload);
            commit('setLastname', response.data);
        } catch (e){
            console.log(e.response.data.detail);
            //commit('setHasError', e.response.data())
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