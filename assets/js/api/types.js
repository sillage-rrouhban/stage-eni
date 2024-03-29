import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {
    getAll() {
        return axios.get('/api/types', config);
    },
    get(){
      return axios.get('api/types',config);
    }
}