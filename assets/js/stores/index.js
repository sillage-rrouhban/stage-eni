import {createLogger, createStore} from "vuex";
import counter from './modules/counter';
import domains from './modules/domains';
import levels from './modules/levels';
import users from './modules/users';
import types from './modules/types'



const debug = process.env.NODE_ENV !== 'production'
export default createStore({
    modules: {
        counter,
        domains,
        levels,
        users,
        types,
    },
    strict: debug,
    plugins: debug?[createLogger()]: []
})