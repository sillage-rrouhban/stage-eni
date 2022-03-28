import {createLogger, createStore} from "vuex";
import counter from './modules/counter';
import domains from './modules/domains';
import levels from './modules/levels';
import users from './modules/users';
import types from './modules/types'
import firstname from './modules/firstnames'
import lastname from './modules/lastnames';
import security from './modules/security';



const debug = process.env.NODE_ENV !== 'production'
export default createStore({
    modules: {
        counter,
        domains,
        levels,
        users,
        types,
        firstname,
        lastname,
        security
    },
    strict: debug,
    plugins: debug?[createLogger()]: []
})