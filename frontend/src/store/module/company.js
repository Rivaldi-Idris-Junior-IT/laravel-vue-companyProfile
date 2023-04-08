//import global API
import Api from '../../api'

const company = {

    //set namespace true
    namespaced: true,

    //state
    state: {                
        companies: [],        
    },

    //mutations
    mutations: {
          
        GET_COMPANIES(state, companies) {
            state.companies = companies
        },
        
    },

    //actions
    actions: {
         
         getCompanies({ commit }) {

            Api.get('/company')
            .then(response => {

                
                commit('GET_COMPANIES', response.data.companies)
                

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

export default company