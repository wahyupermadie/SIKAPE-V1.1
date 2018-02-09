<template>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard SMFT Udayana</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div id="exTab2">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a  href="#1" data-toggle="tab">Tambah Kegiatan</a>
                </li>
                <li><a href="#2" data-toggle="tab">Tambah Mahasiswa</a>
                </li>
                <li><a href="#3" data-toggle="tab">Solution</a>
                </li>
            </ul>
            <br>
            <div class="tab-content ">
                <div class="tab-pane active" id="1">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Basic Form Elements
                                </div>
                                <div class="panel-body">
                                    <form v-on:submit.prevent="addKegiatan()" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="nama" placeholder="Nama Kegiatan" v-model="kegiatan.nama">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="tahun" v-model="kegiatan.tahun">
                                                <option value="">Pilih Tahun</option>
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                                <option value="2016">2016</option>
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="tahun" v-model="kegiatan.id_jurusan">
                                                <option value="">Pilih Tahun</option>
                                                <option v-for="jurusan in jurusans" :value="jurusan.id">{{jurusan.nama}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="fileSk">Input SK</label>
                                            <input type="file" class="form-control" name="fileSk" id="fileSk" aria-describedby="fileHelp">
                                            <small id="fileHelp" class="form-text text-muted">Upload pdf</small>
                                        </div>
                                        <button type="submit">Simpan</button>
                                    </form>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="tab-pane" id="2">
                    <h3>Notice the gap between the content and tab after applying a background color</h3>
                </div>
                <div class="tab-pane" id="3">
                    <h3>add clearfix to tab-content (see the css)</h3>
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
        data(){
            return{
                kegiatan:{},
                jurusans: []
            }
        },
        created: function()
        {
            this.fetchJurusans();
        },
        methods: {
            addKegiatan(){
                var vm=this
                var formData = new FormData();
                var sk = document.getElementById('fileSk');
                formData.append("sk", sk.files[0]);
                formData.append("nama", vm.kegiatan.nama);
                formData.append("tahun", vm.kegiatan.tahun);
                formData.append("id_jurusan", vm.kegiatan.id_jurusan);
                let uri = '/api/kegiatan';
                axios.post(uri, formData).then((response) => {
                    if(response.data.success)
                    {
                        swal({
                            title: "Berhasil!",
                            text: "Selamat Login Berhasil !",
                            type: "success"
                        }, function() {
                            vm.$router.go({name:'Kegiatan'})
                        });
                        console.log("success")
                    }else{
                        console.log("error")
                    }
                })
            },
            fetchJurusans()
            {
                let uri = '/api/jurusan';
                axios.get(uri).then((response) => {
                    this.jurusans = response.data;
                });
            },
        }
    }
</script>

