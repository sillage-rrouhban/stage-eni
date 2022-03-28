import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/lastnames', config);
    },
    get(payload) {
        return axios.get(payload, config);
    },

    create(payload) {
        return axios.post('/api/lastnames', payload, config);
    },

    edit(payload) {
        return axios.put(payload.iri, payload, config);
    },

    delete(payload) {
        return axios.delete(payload, config);
    }
}