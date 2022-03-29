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
        console.log('Store Getter address', state);
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

    getAddress(state, payload){
        state.error = null
        state.HasError = false
        state.address = payload
        state.addresses = null
    },
    setAddress(state,payload){
        console.log('Store Mutation address', payload);
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
    }),
    createAddress : (async ({state, commit}, payload)=>{
        try {
            const {response} = await addressesApi.create(payload);
            commit('setAddress', response);
            console.log('Store Action Address',response);
        } catch (e){
            commit('setHasError', e.response.data.detail);
        }
    }),
    editAddress : (async ({state, commit}, payload)=>{
        try {
            const iri  = '/api/addresses/' + payload.id;
            const response = await addressesApi.edit(iri,payload);
            commit('setAddress', response.data);
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