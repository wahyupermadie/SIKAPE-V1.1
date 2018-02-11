<template>
<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    {{mahasiswa.nim}} - {{mahasiswa.nama}} 
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!--<div class="container">-->
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Kegiatan</th>
                                <th>Tahun</th>
                                <th>SK</th>
                                <th>Jabatan</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr v-for="panitia in mahasiswa.panitia">
                                    <td>{{panitia.kegiatan.nama}}</td>
                                    <td>{{panitia.kegiatan.tahun}}</td>
                                    <td><a :href="'/documents/'+panitia.kegiatan.sk">Lihat SK</a> </td>
                                    <td>{{panitia.jabatan.nama}}</td>
                                    <td>{{panitia.point}}</td>
                                    <td>Action</td>
                                </tr>
                            </tbody>
                        
                    </table>          
                </div>
            </div>
            

        <!--</div>-->
    </div>
</template>
<script>
import Vue from "vue"
import axios from "axios"
export default {
    
    data(){
        return{
            mahasiswa:{},
            nim:this.$route.params.nim,
            url_doc:'/documents/',
        }
    },
    created(){
        this.fectData()
    },
    methods:{
        fectData(){
            var vm=this
            axios.get('/api/mahasiswa/'+vm.nim)
                .then(function(response){
                    Vue.set(vm.$data,'mahasiswa',response.data)
                    console.log(response.data)
                })
        },
        skUrl(file){
            return `${this.url_doc}`+file
        }
    }
}
</script>

