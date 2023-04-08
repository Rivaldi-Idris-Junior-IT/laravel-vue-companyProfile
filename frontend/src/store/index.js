//import vuex
import { createStore } from 'vuex'

//import module company
import service from './module/service'

//import module company
import catalogue from './module/catalogue'

//import module company
import company from './module/company'

//create store vuex
export default createStore({

    modules: {
        service,
        catalogue,
        company
    }

})