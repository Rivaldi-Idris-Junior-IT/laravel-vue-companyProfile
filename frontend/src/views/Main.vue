<template>
    <!-- Hero Section -->
    <section id="hero">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-md-6 hero-tagline ">
                    <h1>Make Health People Around The World</h1>
                    <p>Is the one of health industry to serve medicine need from hospital in singapura </p>

                    <button class="button-lg-primary">Find What You Need</button>
                    <a href="" class="ml-3">
                        <img src="../assets/img/thin-chevron-arrow-right-icon.png" alt="" width="20">
                    </a>
                </div>
            </div>

            <img src="../assets/img/building-medicine-industry-removebg-preview.png" alt="" class="position-absolute end-0 bottom-0 mb-5">
        </div>
    </section>

    <section id="layanan">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Layanan Kami</h2>
                    <span class="sub-title">Berikut Layanan yang kami berikan</span>
                </div>
            </div>

            <div class="row" >
                <div class="col-md-4 text-center" v-for="service in services" :key="service.id">
                    <div class="card-layanan mt-5">
                        <div class="circle-icon position-relative mx-auto">
                            <img :src="service.image" alt="" width="80">
                        </div>
                        <h3>{{ service.name_service }}</h3>
                        <div v-html="service.service_desc"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section id="katalog">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Katalog Obat kesehatan yang berikan </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-4 mt-5" v-for="catalogue in catalogues" :key="catalogue.id">
                    <div class="card p-2"  style="width: 22rem;">
                        <img :src="catalogue.image" alt="">
                        <div class="card-body nama-produk">
                            <h4>{{ catalogue.name }}</h4>
                            <h4>IDR. 35,000 </h4>
                        </div>

                        <div class="card-keterangan p-2">
                            <span>
                                Status Konsumsi:
                            </span> <p>Mengikuti Anjuran Dokter</p>
                            
                        </div>
                    </div>
                </div>                
            </div>            
        </div>
    </section>    
</template>
<script>
    import { computed, ref, onMounted } from 'vue'
    import { useStore } from 'vuex'
    import { useRoute, useRouter } from 'vue-router'    
        
    export default {
        name: 'DataComponent',

        setup() {
            
                // vue route
            const route = useRoute()

            //vue router
            const router = useRouter()
        
            
            //store vuex
            const store = useStore()

            onMounted(() => {                
                
                store.dispatch('service/getServices')

                store.dispatch('catalogue/getCatalogues')
                
            })            
             
            const services = computed(() => {
                return store.state.service.services
            })            

            const catalogues = computed(() => {
                return store.state.catalogue.catalogues
            })            

            return {                
                store,
                services,                
                catalogues
            }

        }
        
    }
</script>