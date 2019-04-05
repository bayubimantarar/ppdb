<?php

namespace App\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use App\Models\CalonPesertaDidik;
use App\Http\Requests\CalonPesertaDidikRequest;

class CalonPesertaDidikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $calonPesertaDidik = CalonPesertaDidik::all();

        $dataTablesCalonPesertaDidik = DataTables($calonPesertaDidik)
            ->addColumn('action', function($calonPesertaDidik){
                return '
                    <a
                        href="#hapus"
                        id="delete-button"
                        class="btn btn-sm btn-danger"
                        onclick="destroy('.$calonPesertaDidik->id.')"
                    >
                        <i class="fas fa-times"></i> Hapus
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();

        return $dataTablesCalonPesertaDidik;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calon_peserta_didik.calon_peserta_didik');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('calon_peserta_didik.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalonPesertaDidikRequest $calonPesertaDidikRequest)
    {
        $nisn       = $calonPesertaDidikRequest->nisn;
        $alamat     = $calonPesertaDidikRequest->alamat;
        $latitude   = $calonPesertaDidikRequest->latitude;
        $longitude  = $calonPesertaDidikRequest->longitude;
        $nilaiNHUN  = $calonPesertaDidikRequest->nilai_nhun;
        $skorJarak  = $calonPesertaDidikRequest->skor_jarak;
        $skorTotal  = $calonPesertaDidikRequest->skor_total;

        $data = [
            'nisn'          => $nisn,
            'alamat'        => $alamat,
            'latitude'      => $latitude,
            'longitude'     => $longitude,
            'nilai_nhun'    => $nilaiNHUN,
            'skor_jarak'    => $skorJarak,
            'skor_total'    => $skorTotal
        ];

        $storeCalonPesertaDidik = CalonPesertaDidik::create($data);

        return redirect('/calon-peserta-didik')
            ->with([
                'notification' => 'Data berhasil disimpan!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $deleteCalonPesertaDidik = CalonPesertaDidik::destroy($id);

        return response()
            ->json('Data berhasil dihapus!', 200);
    }
}
