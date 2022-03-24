import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/domains', config);
    }
}