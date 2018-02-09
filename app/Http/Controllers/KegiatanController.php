<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kegiatans;


class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan= Kegiatans::all();
        return response()->json($kegiatan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah_kepanitiaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request;
        if($request->hasFile('sk')) {
            $sk = $request->file('sk');
            $file_name = "sk_" . $request->get('nama') . '_' . $request->get('tahun') . '.' . $sk->extension();
            $destinationPath = 'documents';
            $request->sk->move($destinationPath, $file_name);

            $kegiatan = new Kegiatans();
            $kegiatan->name = $request->get('nama');
            $kegiatan->tahun = $request->get('tahun');
            $kegiatan->id_jurusan = $request->get('id_jurusan');
            $kegiatan->sk = $file_name;
            $kegiatan->save();

            return response()->json(["success" => '1']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kegiatans = Kegiatans::select('*')
        ->where(['id_jurusan'=>$id])->paginate(5);
        return response()->json($kegiatans);
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
