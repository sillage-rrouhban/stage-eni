import axios from 'axios';

const config = {
    headers : {
        'Content-Type': 'application/ld+json;'
    }
}

export default {

    login(payload){
        return axios.post('/auth_token', payload, config);
    },

    fetchUser(token) {
        let configToken = {
            headers:{
                'Content-Type': 'application/ld+json;',
                'Authorization': 'bearer ' + token
            }
        };
        return axios.get('/api/me', configToken);
    },
}