<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/building.png" alt="" width="30" class="d-inline-block align-text-top mr-3">
                MEDICAL INDUSTRY
            </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item mx-2 active">
                    <a class="nav-link" href="#">BERANDA <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">LAYANAN</a>
                </li>                
                <li class="nav-item mx-2">
                    <a class="nav-link" href="#">HUBUNGI KAMI</a>
                </li>                
                
            </ul>
            <div>
                <button class="button-primary">Daftar</button>
                <button class="button-secondary">Masuk</button>
            </div>
        </div>
        </div>
    </nav>
    
</template>
<script>
    export default {
        name: 'HeaderComponent',
    }    
</script>