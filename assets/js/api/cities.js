import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/cities', config);

    },
    get(payload) {
        return axios.get('/api/cities/' + payload, config);
    },
    create(payload){
        return axios.post('/api/cities',payload , config);
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
