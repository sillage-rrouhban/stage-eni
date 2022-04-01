import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/users', config);
    },
    get(payload) {
        return axios.get(payload, config);
    },
    create(payload) {
        return axios.post('/api/users', payload, config);
    },
    edit(payload) {
        const patchHeaders = {
            headers: {'Content-Type': 'application/merge-patch+json;'}
        };
        return axios.patch(payload.iri, payload, patchHeaders);
    },
    delete(payload) {
        return axios.delete(payload);
    }
}
