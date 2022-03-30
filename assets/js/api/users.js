import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/users');
    },
    get(payload) {
        return axios.get(payload);
    },

    create(payload) {
        return axios.post('/api/users', payload);
    },

    edit(payload) {
        return axios.put(payload.iri, payload);
    },

    delete(payload) {
        return axios.delete(payload);
    }
}