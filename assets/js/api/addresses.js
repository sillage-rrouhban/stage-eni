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
        return axios.post('/api/cities',payload, config);
    }
}