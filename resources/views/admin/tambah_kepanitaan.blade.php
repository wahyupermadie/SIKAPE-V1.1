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
                <a v-on:click="removeElement(index);" style="cursor: pointer">Remove</a>
            </td>
        </tr>
        </tbody>
    </table>
    <button class="button btn-primary" @click="addRow">Add row</button>
    <button type="submit">Simpan</button>
</form>