<template>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard {{jurusan.nama}}<div style="float: right"><button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Kepanitiaan</button></div></h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div id="exTab2">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a  href="#1" data-toggle="tab">Daftar Kegiatan</a>
                </li>
                <li><a href="#2" data-toggle="tab">Daftar Mahasiswa</a>
                </li>
            </ul>
            <br>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <div class="row">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tahun</th>
                                    <th>Surat Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody v-if="kegiatans.length">
                                <tr v-for="kegiatan in kegiatans">
                                    <td>{{kegiatan.id}}</td>
                                    <td>{{kegiatan.name}}</td>
                                    <td>{{kegiatan.tahun}}</td>
                                    <td>{{kegiatan.sk}}</td>
                                    <td><button class="btn btn-primary">DOWNLOAD SK</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="body" align="right">
                                <pagination :data="kegiatansData" v-on:pagination-change-page="getHalaman" :limit="3"></pagination>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="tab-pane" id="2">
                    <div class="row">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" >
                                <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No Telepon</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Poin SKP</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="mahasiswa in mahasiswas">
                                    <td>{{mahasiswa.nim}}</td>
                                    <td>{{mahasiswa.nama}}</td>
                                    <td>{{mahasiswa.alamat}}</td>
                                    <td>{{mahasiswa.no_telp}}</td>
                                    <td>{{mahasiswa.tanggal_lahir}}</td>
                                    <td>{{mahasiswa.point}}</td>
                                    <td><button class="btn btn-primary">EDIT</button></td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form v-on:submit.prevent="addItem()">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <td><strong>NIM</strong></td>
                                    <td><strong>KEGIATAN</strong></td>
                                    <td><strong>JABATAN</strong></td>
                                    <td><strong>ACTION</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(row, index) in rows">
                                    <td><input type="text" v-model="row.nim"></td>
                                    <td><input type="text" v-model="row.kegiatan"></td>
                                    <td><input type="text" v-model="row.jabatan"></td>
                                    <td>
                                        <a class="btn btn-danger" v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" @click="addRow">Add row</button>
                            <button class="btn btn-success" type="submit">Simpan</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-wrapper -->
</template>
<script>
    import axios from 'axios'
    import vue from 'vue'
    export default {
        metaInfo: {
            // if no subcomponents specify a metaInfo.title, this title will be used
            title: 'SIKAPE',
            // all titles will be injected into this template
            titleTemplate: '%s | SISTEM INFORMASI SKP'
        },
        data(){
            return{
                jurusan:{},
                mahasiswas: [],
                kegiatans: [],
                kegiatan: {},
                rows:[],
                kegiatansData:{},
                loading: true,
                errors: [],
            }
        },
        created: function()
        {
            this.getJurusan()
            this.fetchMahasiswas()
            this.getHalaman()
        },
        methods: {
            getHalaman(page) {
                var app = this;
                if (typeof page === 'undefined'){
                    page = 1;
                }
                axios.get(`/api/kegiatan/jurusan/${this.$route.params.id}?page=`+page)
                    .then(function (resp){
                        app.kegiatans = resp.data.data;
                        app.kegiatansData = resp.data;
                        app.loading = false;
                    })
                    .catch(function (resp){
                        console.log(resp);
                        app.loading = false;
                        alert("Could not load halaman");
                    });
            },
            fetchMahasiswas()
            {
              let uri = `/api/mahasiswa/jurusan/${this.$route.params.id}`
                axios.get(uri).then((response) => {
                  this.mahasiswas = response.data;
                })
            },
            getJurusan()
            {
                let uri = `/api/jurusan/${this.$route.params.id}`;
                axios.get(uri).then((response) => {
                    this.jurusan = response.data;
                });
            },
//            fetchKegiatans()
//            {
//                let uri = `http://127.0.0.1:8000/api/kegiatan/${this.$route.params.id}`;
//                axios.get(uri).then((response) => {
//                    this.kegiatans = response.data;
//                });
//
//            },
            watch: {
                '$route.params.id': 'fetchKegiatans',
            },
            addItem() {
                let uri = 'http://127.0.0.1:8000/api/kegiatan';
                axios.post(uri, this.kegiatan).then((response) => {
                    this.$router.push({name: 'Jurusan'})
                })
            },
            addRow: function() {
                var elem = document.createElement('tr');
                this.rows.push({
                    nim: "",
                    jabatan: "",
                    kegiatan:""
                });
            },
            removeElement: function(index) {
                this.rows.splice(index, 1);
            }
        }
    }
</script>

