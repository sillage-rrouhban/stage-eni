import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/firstnames', config);
    },
    get(payload) {
        return axios.get(payload, config);
    },

    create(payload) {
        return axios.post('/api/firstnames', payload, config);
    },

    edit(iri,payload) {
        const editConfig = {headers: {'Content-Type': 'application/merge-patch+json;'}}
        return axios.patch(iri, payload, editConfig);
    },

    delete(payload) {
        return axios.delete(payload, config);
    }
}