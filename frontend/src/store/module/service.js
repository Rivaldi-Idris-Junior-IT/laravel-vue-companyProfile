//import global API
import Api from '../../../src/api'

const service = {

    //set namespace true
    namespaced: true,

    //state
    state: {
                
        services: [],
    },

    //mutations
    mutations: {
          
          GET_SERVICES(state, services) {
            state.services = services
        },
    },

    //actions
    actions: {
         
         getServices({ commit }) {

            Api.get('/service')
            .then(response => {

                
                commit('GET_SERVICES', response.data.services)
                

            }).catch(error => {

                //show error log dari response
                console.log(error)

            })
        },
    },

    //getters
    getters: {

    }

}

export default service