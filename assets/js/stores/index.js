import {createLogger, createStore} from "vuex";
import counter from './modules/counter';
import domains from './modules/domains';
import levels from './modules/levels';
import users from './modules/users';
import types from './modules/types'
import firstnames from './modules/firstnames'
import lastnames from './modules/lastnames';
import security from './modules/security';
import addresses from "./modules/addresses";
import cities from "./modules/cities";
import zipcodes from "./modules/zipcodes";
import birthdates from "./modules/birthdates";
import cvs from "./modules/cvs";



const debug = process.env.NODE_ENV !== 'production'
export default createStore({
    modules: {
        counter,
        domains,
        levels,
        users,
        types,
        firstnames,
        lastnames,
        security,
        addresses,
        cities,
        zipcodes,
        birthdates,
        cvs,

    },
    strict: debug,
    plugins: debug?[createLogger()]: []
})