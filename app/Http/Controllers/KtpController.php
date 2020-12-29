<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_ktp;
use App\Models\ms_kota;
use App\Models\ms_provinsi;
use Carbon\Carbon;
use Auth;

class KtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = "";
        $mst_ktp = master_ktp::orderBy('nama')->get();
        $mst_provinsi = ms_provinsi::all();
        $mst_kota = ms_kota::all();
        $data_param = [
            'mst_ktp','mst_provinsi','mst_kota','provinsi'
        ];
        return view('/crud/index')->with(compact($data_param));
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
        $request->validate([
            'no_ktp' => 'required|digits:16',
            'nama' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kel' => 'required',
            'alamat' => 'required',
            'kab_kota' => 'required',
            'prov' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pekerjaan' => 'required',
            'warga' => 'required'
        ],
        ['no_ktp.required'=>'NIK harus diisi',
        'no_ktp.digits'=>'NIK harus 16 Digit',
        'nama.required'=>'Nama harus diisi',
        'tmp_lahir.required'=>'Tempat Lahir harus diisi',
        'tgl_lahir.required'=>'Tanggal Lahir harus diisi',
        'jns_kel.required'=>'Jenis Kelamin harus diisi',
        'alamat.required'=>'Alamat harus diisi',
        'kab_kota.required'=>'Kab/Kota harus diisi',
        'prov.required'=>'Provinsi harus diisi',
        'agama.required'=>'Agama harus diisi',
        'status.required'=>'Status Perkawinan harus diisi',
        'pekerjaan.required'=>'Pekerjaan harus diisi',
        'warga.required'=>'Kewarganegaraan harus diisi'       
        ]
        );

        $data['no_ktp'] = $request->no_ktp;
        $data['nama'] = $request->nama;
        $data['tmp_lahir'] = $request->tmp_lahir;
        $data['tgl_lahir'] = $request->tgl_lahir;
        $data['jns_kel'] = $request->jns_kel;
        $data['alamat'] = $request->alamat;
        $data['kab_kota'] = $request->kab_kota;
        $data['prov'] = $request->prov;
        $data['agama'] = $request->agama;
        $data['status'] = $request->status;
        $data['pekerjaan'] = $request->pekerjaan;
        $data['warga'] = $request->warga;

        $data['created_by'] = Auth::id();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        master_ktp::create($data); 
        return response()->json([
            'icon' => "success",
            'message' => 'Data KTP berhasil ditambah'
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
        $request->validate([
            'no_ktp_'.$id => 'required|digits:16',
            'nama_'.$id => 'required',
            'tmp_lahir_'.$id => 'required',
            'tgl_lahir_'.$id => 'required',
            'jns_kel_'.$id => 'required',
            'alamat_'.$id => 'required',
            'kab_kota_'.$id => 'required',
            'prov_'.$id => 'required',
            'agama_'.$id => 'required',
            'status_'.$id => 'required',
            'pekerjaan_'.$id => 'required',
            'warga_'.$id => 'required'
        ],
        [
        'no_ktp_'.$id.'.required'=>'NIK harus diisi',
        'no_ktp_'.$id.'.digits'=>'NIK harus 16 Digit',
        'nama_'.$id.'.required'=>'Nama harus diisi',
        'tmp_lahir_'.$id.'.required'=>'Tempat Lahir harus diisi',
        'tgl_lahir_'.$id.'.required'=>'Tanggal Lahir harus diisi',
        'jns_kel_'.$id.'.required'=>'Jenis Kelamin harus diisi',
        'alamat_'.$id.'.required'=>'Alamat harus diisi',
        'kab_kota_'.$id.'.required'=>'Kab/Kota harus diisi',
        'prov_'.$id.'.required'=>'Provinsi harus diisi',
        'agama_'.$id.'.required'=>'Agama harus diisi',
        'status_'.$id.'.required'=>'Status Perkawinan harus diisi',
        'pekerjaan_'.$id.'.required'=>'Pekerjaan harus diisi',
        'warga_'.$id.'.required'=>'Kewarganegaraan harus diisi'       
        ]
        );

        $x = "no_ktp_".$id;
        $data['no_ktp'] = $request->$x;
        $x = "nama_".$id;
        $data['nama'] = $request->$x;
        $x = "tmp_lahir_".$id;
        $data['tmp_lahir'] = $request->$x;
        $x = "tgl_lahir_".$id;
        $data['tgl_lahir'] = $request->$x;
        $x = "jns_kel_".$id;
        $data['jns_kel'] = $request->$x;
        $x = "alamat_".$id;
        $data['alamat'] = $request->$x;
        $x = "kab_kota_".$id;
        $data['kab_kota'] = $request->$x;
        $x = "prov_".$id;
        $data['prov'] = $request->$x;
        $x = "agama_".$id;
        $data['agama'] = $request->$x;
        $x = "status_".$id;
        $data['status'] = $request->$x;
        $x = "pekerjaan_".$id;
        $data['pekerjaan'] = $request->$x;
        $x = "warga_".$id;
        $data['warga'] = $request->$x;

        $data['updated_by'] = Auth::id();
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        master_ktp::find($id)->update($data); 
        return response()->json([
            'icon' => "success",
            'message' => 'Data KTP berhasil diedit'
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
        $data['deleted_by'] = Auth::id();
        $data['deleted_at'] = Carbon::now()->toDateTimeString();
        master_ktp::find($id)->update($data); 
        return response()->json([
            'icon' => "success",
            'message' => 'Data KTP berhasil dihapus'
        ]);
    }

    public function changeprov(Request $request){
            return $data = ms_kota::where('provinsi_id', '=', $request->prov)
                ->get(['id','nama as text']);
    }

    public function filter(Request $request){
        $provinsi = $request->filterprov;
        $mst_ktp = master_ktp::orderBy('nama');
        if($provinsi){
            $mst_ktp->where('prov',$provinsi);
        }
        $mst_ktp = $mst_ktp->get();
        $mst_provinsi = ms_provinsi::all();
        $mst_kota = ms_kota::all();
        $data_param = [
            'mst_ktp','mst_provinsi','mst_kota','provinsi'
        ];
        return view('/crud/index')->with(compact($data_param));
    }
}
