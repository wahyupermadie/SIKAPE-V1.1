<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Kegiatans extends Model
{
    public function jurusan()
    {
        return $this->belongsTo('App\Jurusans','id_jurusan');
    }
    public function panitia(){
        return $this->hasMany('App\Panitias','id_kegiatan');
    }
}