//import global API
import Api from '../../../src/api'

const catalogue = {

    //set namespace true
    namespaced: true,

    //state
    state: {                
        catalogues: [],
    },

    //mutations
    mutations: {
          
          GET_CATALOGUES(state, catalogues) {
            state.catalogues = catalogues
        },
    },

    //actions
    actions: {
         
         getCatalogues({ commit }) {

            Api.get('/catalogue')
            .then(response => {

                
                commit('GET_CATALOGUES', response.data.catalogues)
                

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

export default catalogue