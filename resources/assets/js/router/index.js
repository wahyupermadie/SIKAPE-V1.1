import Vue from 'vue'
import Router from 'vue-router'
import Meta from 'vue-meta'
import Spinner from 'vue-simple-spinner'

Vue.use(Router)
Vue.use(Meta)
Vue.use(Spinner)

import Kegiatan from '../components/KegiatanComponent'
import Mahasiswa from '../components/MahasiswaComponent'
import Jurusan from '../components/JurusanComponent.vue'
import DetailKegiatan from '../components/DetailKegiatanComponent'
import DetailMahasiswa from '../components/DetailMahasiswaComponent'


Vue.component('vue-simple-spinner',require('vue-simple-spinner'));
Vue.component('pagination', require('laravel-vue-pagination'));
const router= new Router({
    mode: 'history',
    routes: [
        {
            path: '/kegiatan/:id_kegiatan',
            name: 'DetailKegiatan',
            component: DetailKegiatan},
        {
            name: 'Kegiatan',
            path: '/kegiatan',
            component: Kegiatan},
        {
            name: 'Mahasiswa',
            path: '/mahasiswa',
            component: Mahasiswa
        },
        {
            name: 'Jurusan',
            path: '/jurusan/:id',
            component: Jurusan
        },
        {
            name: 'DetailMahasiswa',
            path: '/mahasiswa/:nim',
            component: DetailMahasiswa
        },
    ]
})

export default router
