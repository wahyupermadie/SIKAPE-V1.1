<template>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard {{kegiatan.nama}}<div style="float: right"><button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Kepanitiaan</button></div></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!--<div class="container">-->
            <div class="row">
                <div class="col-md-12">
                    <h1>{{kegiatan.nama}}</h1>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Panitia</button>
                    <table class="table">
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Point</th>
                            <th>Action</th>
                        </tr>
                        <tr v-for="result in kegiatan.panitia">
                            <td>{{result.nim}}</td>
                            <td>{{result.mahasiswa.nama}}</td>
                            <td>{{result.jabatan.nama}}</td>
                            <td>{{result.point}}</td>
                            <td>Action</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form v-on:submit.prevent="addPanitia()">
                                <div class="form-group">
                                    <select class="form-control" name="nim" v-model="panitia.nim">
                                        <option value="">Pilih NIM</option>
                                        <option :value="mahasiswa.nim" v-for="mahasiswa in mahasiswas">{{mahasiswa.nim}} - {{mahasiswa.nama}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="jabatan" v-model="panitia.id_jabatan">
                                        <option value="">Pilih Jabatan</option>
                                        <option v-for="jabatan in jabatans" :value="jabatan.id">{{jabatan.nama}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="point" placeholder="Point" v-model="panitia.point">
                                </div>
                                <button type="submit">Simpan</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

        <!--</div>-->
    </div>
</template>
<script>
    import axios from 'axios'
    import Vue from 'vue'
    export default {
        data:function(){
            return {
                kegiatan:{
                    'nama':'',
                    'id_jurusan':''
                },
                mahasiswas:{
                },
                jabatans:{
                },
                panitia:{
                    'id_kegiatan':'',
                    'nim':'',
                    'id_jabatan':'',
                    'point':''
                },
                url:'/api/kegiatan/'+this.$route.params.id_kegiatan,
                add_url:'/api/panitia'
            }
        },
        created:function(){
            this.fetchData()
            this.fectJabatan()
        },
        methods:{
            fetchData(){
                var vm=this
                axios.get(`${this.url}`)
                    .then(function(response){
                        Vue.set(vm.$data,'kegiatan',response.data)
                        vm.fectMahasiswa()
                    })
            },
            fectMahasiswa(){
                var vm=this
                axios.get('/api/mahasiswa/jurusan/'+vm.kegiatan.id_jurusan)
                    .then(function(response){
                        Vue.set(vm.$data,'mahasiswas',response.data)
                    })
            },
            fectJabatan(){
                var vm=this
                axios.get('/api/jabatan')
                    .then(function(response){
                        Vue.set(vm.$data,'jabatans',response.data)
                    })
            },
            addPanitia(){
                var vm=this
                vm.panitia.id_kegiatan=vm.kegiatan.id

                // console.log(vm.panitia)
                var dataInput=vm.panitia
                axios.post(`${this.add_url}`,dataInput)
                    .then(function(response){
                        $("#addModal").modal('hide')
                        vm.panitia.nim=''
                        vm.panitia.id_jabatan=''
                        vm.panitia.point=''
                        vm.fetchData()
                    })
            }
        }
    }
</script>