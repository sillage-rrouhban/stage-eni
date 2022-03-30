import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/addresses', config);
    },
    get(payload) {
        return axios.get('/api/addresses/' + payload, config);
    },
    create(payload){
        return axios.post('/api/addresses',payload, config).then((res) => console.log(res) )
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
