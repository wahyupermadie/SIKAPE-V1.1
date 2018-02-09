<template>
    <div id="app">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SKP FAKULTAS TEKNIK UDAYANA</a>
            </div>
            <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <router-link to="/kegiatan"><i class="fa fa-dashboard fa-fw"></i>Dashboard</router-link>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Daftar Jurusan<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li v-for="jurusan in jurusans">
                            <router-link :to="{name: 'Jurusan', params: { id: jurusan.id}}">{{ jurusan.nama }}</router-link>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
    </nav>
        <div>
            <router-view :key="$route.path"></router-view>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import vue from 'vue'
    export default {
        data(){
            return{
                jurusans: []
            }
        },
        created: function()
        {
            this.fetchJurusans();
        },
        methods: {
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