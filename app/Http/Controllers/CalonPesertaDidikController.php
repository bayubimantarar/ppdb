<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Alamat;
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
        $calonPesertaDidik = CalonPesertaDidik::with('alamat')->get();

        $dataTablesCalonPesertaDidik = DataTables($calonPesertaDidik)
            ->addColumn('action', function($calonPesertaDidik){
                return '
                    <center>
                        <a
                            href="/calon-peserta-didik/form-ubah/'.$calonPesertaDidik->id.'"
                            class="btn btn-sm btn-warning"
                        >
                            <i class="fas fa-pencil-alt"></i> Ubah
                        </a>
                        <a
                            href="#hapus"
                            id="delete-button"
                            class="btn btn-sm btn-danger"
                            onclick="destroy('.$calonPesertaDidik->id.')"
                        >
                            <i class="fas fa-times"></i> Hapus
                        </a>
                    </center>
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
        $nisn           = $calonPesertaDidikRequest->nisn;
        $provinsi       = $calonPesertaDidikRequest->provinsi;
        $kabupatenKota  = $calonPesertaDidikRequest->kabupaten_kota;
        $kecamatan      = $calonPesertaDidikRequest->kecamatan;
        $kodePos        = $calonPesertaDidikRequest->kode_pos;
        $alamat         = $calonPesertaDidikRequest->alamat;
        $latitude       = $calonPesertaDidikRequest->latitude;
        $longitude      = $calonPesertaDidikRequest->longitude;
        $nilaiNHUN      = $calonPesertaDidikRequest->nilai_nhun;
        $skorJarak      = $calonPesertaDidikRequest->skor_jarak;
        $skorTotal      = $calonPesertaDidikRequest->skor_total;

        $dataCalonPesertaDidik = [
            'nisn'          => $nisn,
            'nilai_nhun'    => $nilaiNHUN,
            'skor_jarak'    => $skorJarak,
            'skor_total'    => $skorTotal
        ];

        $storeCalonPesertaDidik = CalonPesertaDidik::create($dataCalonPesertaDidik);

        $dataAlamat = [
            'calon_peserta_didik_id' => $storeCalonPesertaDidik->id,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kabupaten_kota' => $kabupatenKota,
            'kecamatan' => $kecamatan,
            'kode_pos' => $kodePos,
            'latitude' => $latitude,
            'longitude' => $longitude
        ];

        $storeAlamat = Alamat::create($dataAlamat);

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
        $calonPesertaDidik = CalonPesertaDidik::with('alamat')->findOrFail($id);

        return view('calon_peserta_didik.form_edit', compact('calonPesertaDidik'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalonPesertaDidikRequest $calonPesertaDidikRequest, $id)
    {
        $nisn           = $calonPesertaDidikRequest->nisn;
        $provinsi       = $calonPesertaDidikRequest->provinsi;
        $kabupatenKota  = $calonPesertaDidikRequest->kabupaten_kota;
        $kecamatan      = $calonPesertaDidikRequest->kecamatan;
        $kodePos        = $calonPesertaDidikRequest->kode_pos;
        $alamat         = $calonPesertaDidikRequest->alamat;
        $latitude       = $calonPesertaDidikRequest->latitude;
        $longitude      = $calonPesertaDidikRequest->longitude;
        $nilaiNHUN      = $calonPesertaDidikRequest->nilai_nhun;
        $skorJarak      = $calonPesertaDidikRequest->skor_jarak;
        $skorTotal      = $calonPesertaDidikRequest->skor_total;

        $dataCalonPesertaDidik = [
            'nisn'          => $nisn,
            'nilai_nhun'    => $nilaiNHUN,
            'skor_jarak'    => $skorJarak,
            'skor_total'    => $skorTotal
        ];

        $updateCalonPesertaDidik = CalonPesertaDidik::where('id', $id)
            ->update($dataCalonPesertaDidik);

        $dataAlamat = [
            'calon_peserta_didik_id' => $id,
            'alamat' => $alamat,
            'provinsi' => $provinsi,
            'kabupaten_kota' => $kabupatenKota,
            'kecamatan' => $kecamatan,
            'kode_pos' => $kodePos,
            'latitude' => $latitude,
            'longitude' => $longitude
        ];

        $updateAlamat = Alamat::where('calon_peserta_didik_id', $id)
            ->update($dataAlamat);

        return redirect('/calon-peserta-didik')
            ->with([
                'notification' => 'Data berhasil diubah!'
            ]);
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
