import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/zipcodes', config);

    },
    get(payload) {
        return axios.get('/api/zipcodes/' + payload, config);
    },
    create(payload){
        return axios.post('/api/zipcodes', payload, config);
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
