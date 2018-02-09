import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Kegiatan from '../components/KegiatanComponent'
import Mahasiswa from '../components/MahasiswaComponent'
import Jurusan from '../components/JurusanComponent.vue'
import DetailKegiatan from '../components/DetailKegiatanComponent'

const router= new Router({
    mode: 'history',
    routes: [
        {
            path: '/kegiatan/detail/:id_kegiatan',
            name: 'DetailKegiatan',
            component: DetailKegiatan},
        {
            name: 'Kegiatan',
            path: '/kegiatan',
            component: Kegiatan},
        {
            name: 'Mahasiswa',
            path: '/mahasiswa',
            component: Mahasiswa},
        {
            name: 'Jurusan',
            path: '/jurusan/:id',
            component: Jurusan},
    ]
})

export default router
