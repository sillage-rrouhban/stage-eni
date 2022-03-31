import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
};

const configFormData = {
    headers : {
        'Content-Type': 'multipart/form-data'
    }
}

export default {
    getAll() {
        return axios.get('/api/cvs', config);
    },
    get(payload) {
        return axios.get('/api/cvs/' + payload, config);
    },
    create(payload){
        return axios.post('/api/cvs',payload, configFormData);
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
