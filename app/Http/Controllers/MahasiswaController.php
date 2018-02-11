<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswas;
use App\Panitias;
class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function showByJurusan($id_jurusan){
        $mahasiswa=Mahasiswas::where('id_jurusan',$id_jurusan)
            ->paginate(10);
        foreach($mahasiswa as $data){
            $panitias=Panitias::where('nim',$data->nim)->get();
            $point=0;
            foreach($panitias as $panitia){
                $point+=$panitia->point;
            }
            $data->point=$point;
        }
        return response()->json($mahasiswa);
    }
    public function showPoint($id_jurusan){
        $mahasiswa=Mahasiswas::where('id_jurusan',$id_jurusan)
            ->get();
        return response()->json($mahasiswa);
    }
    public function search(Request $request,$id_jurusan)
    {# code...
//        return $request;
        $mahasiswa=Mahasiswas::where('id_jurusan',$id_jurusan)
            ->where('nim', 'LIKE', "%$request->q%")
            ->paginate(10);
        foreach($mahasiswa as $data){
            $panitias=Panitias::where('nim',$data->nim)->get();
            $point=0;
            foreach($panitias as $panitia){
                $point+=$panitia->point;
            }
            $data->point=$point;
        }
        return response()->json($mahasiswa);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa=Mahasiswas::with('panitia.kegiatan')
            ->with('panitia.jabatan')
            ->where('nim',$id)->first();
        return response()->json($mahasiswa);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
