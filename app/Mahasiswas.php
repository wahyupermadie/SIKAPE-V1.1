<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Mahasiswas extends Model
{
    protected $primaryKey="nim";
    public function panitia(){
        return $this->hasMany('App\Panitias','nim');
    }
    public function panitiaCount(){
        return $this->panitia()
            ->selectRaw('sum(point) as aggregate')
            ->groupBy('id');
    }
}
