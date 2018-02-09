<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Panitias extends Model
{
    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswas','nim');
    }
    public function jabatan(){
        return $this->belongsTo('App\Jabatans','id_jabatan');
    }
}