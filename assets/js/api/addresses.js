import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/addresses', config);

    },
    create(payload){
        return axios.post('/api/addresses',payload, config);
    },

    edit(iri,payload) {
        const patchHeaders = {
            headers: {'Content-Type': 'application/merge-patch+json;'}
        };
        return axios.patch(iri, payload, patchHeaders);
    },

    delete(payload) {
        return axios.delete(payload, config);
    }
}