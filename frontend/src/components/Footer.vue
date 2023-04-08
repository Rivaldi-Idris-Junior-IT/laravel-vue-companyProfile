<template>
    <section id="contact">
        <div class="container-fluid overlay h-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Ingin tahu lebih dengan produk kami..? Silahkan hubungi kami kontak dibawah ini</h3>
                        <div class="kontak">
                            <h6>Kontak Kami</h6>
                            <div class="mb-3 d-flex align-items-center"  v-for="company in companies" :key="companies.id">
                                <div>
                                    <img src="../assets/img/location.png" alt="" width="30">
                                    <a href="">{{ company.address }}</a>
                                </div>
                            </div>
                            <div class="mb-3" v-for="company in companies" :key="companies.id">
                                <img src="../assets/img/phone.png" alt="" width="30">
                                <a href="">{{ company.phone }}</a>
                            </div>
                            <div class="mb-3" v-for="company in companies" :key="companies.id">
                                <img src="../assets/img/message.png" alt="" width="30">
                                <a href="">{{ company.email_company }}</a>
                            </div>                                            
                        </div>
                        <h6>Social Media</h6>
                        <a href="#" class="me-2"><img src="../assets/img/facebook.png" alt="" width="30"></a>
                        <a href="#" class="me-2"><img src="../assets/img/twitter.png" alt="" width="30"></a>
                        <a href="#" class="me-2"><img src="../assets/img/instagram.png" alt="" width="30"></a>
                        <a href="" class="medicalindustry">MEDICAL INDUSTRY</a>
                    </div>
                    <div class="col-md-6">
                        <div class="card-contact w-100">
                            <form action="">
                                <h2>Ada Pertanyaan..?</h2>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput" class="d-flex align-items-center">Masukkan Email anda disini</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                                    <label for="floatingInput" class="d-flex align-items-center">Ada yang ingin ditanyakan</label>
                                </div>

                                <button type="submit" class="button-kontak">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="d-flex align-items-center position-relative">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 d-flex align-items-center">
                        <img src="../assets/img/building.png" alt="" width="30">
                        <a href="" class="ms-5">Medical Industry</a>
                    </div>
                    <div class="col-md-5 d-flex justify-content-evenly">
                        <a href="#hero">Beranda</a>
                        <a href="#layanan">Layanan</a>
                        <a href="#fitur">Fitur</a>
                        <a href="#contact">Kontak</a>
                    </div>
                </div>
                <div class="row position-absolute copyright start-50 translate-middle">
                    <div class="col-12">
                        <p>Copyright by Rivaldi Idris Allright Reserved</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<script>
    import { computed, ref, onMounted } from 'vue'
    import { useStore } from 'vuex'
    import { useRoute, useRouter } from 'vue-router'    

    export default {
        name: 'FooterComponent',

        setup() {
            
            // vue route
        const route = useRoute()

        //vue router
        const router = useRouter()
    
        
        //store vuex
        const store = useStore()

        onMounted(() => {                
            
            store.dispatch('company/getCompanies')            
            
        })            
         
        const companies = computed(() => {
            return store.state.company.companies
        })                    
        

        return {                
            store,
            companies,            
        }

    }

    }
</script>