import cvsApi from '@/api/cvs'


const state = {
    error : null,
    hasError : false,
    cvs : null,
    cv : null,
}

const getters = {
    error(state){
        return state.error
    },
    hasError(state){
        return state.hasError
    },
    cv(state){
        return state.cv
    },
    cvs(state){
        return state.cvs
    }
}

const mutations = {
    setHasError(state, payload){
        state.error = payload
        state.HasError = true
        state.cv = null
        state.cvs = null
    },

    getCvs(state, payload){
        state.error = null
        state.HasError = false
        state.cv = null
        state.cvs = payload
    },

    getCv(state, payload){
        state.error = null
        state.HasError = false
        state.cv = payload
        state.cvs = null
    },

    setCv(state,payload){
        state.error = null
        state.HasError = false
        state.cv = payload
        state.cvs = null
    },
}

const actions = {
    fetchCvs : (async ({commit}) => {
        let {data} = await cvsApi.getAll();
        commit('getCvs', data);
    }),
    fetchCv : (async ({commit},payload) => {
        let {data} = await cvsApi.get(payload);
        commit('getCv', data);
    }),
    createCv : (async ({commit}, payload)=>{
        try {
            const response = await cvsApi.create(payload);
            commit('setCv', response.data);
        } catch (e){
            commit('setHasError', e);

        }
    }),
    editCv : (async ({commit}, payload)=>{
        try {
            const response = await cvsApi.edit(payload);
            commit('setCv', response.data);
        } catch (e){
            commit('setHasError', e);
        }
    }),
    deleteCv : (async ({commit},payload)=>{
        try{
            await cvsApi.delete(payload);
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
