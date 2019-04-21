<?php

namespace Sitren\Http\Controllers\Pengurus;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use Sitren\SantriModel;
use Sitren\IjinModel;
use PDF;
use QrCode;
class IjinControl extends Controller
{
    public function index(Request $req)
    {
      if ($req->ajax()) {
        $getdata = IjinModel::orderBy('created_at', 'desc')->orderBy('updated_at', 'desc')->get();
        foreach ($getdata as $key => &$value) {
          $value->nama_santri = $value->santri->nama_lengkap;
          if (isset($value->pengurus->pegawai->nama_pegawai)) {
            $value->nama_pengurus = $value->pengurus->pegawai->nama_pegawai;
          }else {
            $value->nama_pengurus = $value->pengurus->santri->nama_lengkap;
          }
          $value->waktu_rebuild = date("d/m/Y H:i:s",strtotime($value->waktu_start))." - ".date("d/m/Y H:i:s",strtotime($value->waktu_end));
          $value->status_ijin = ucfirst($value->status_ijin);
        }
        $json = datatables_pengurus($getdata,"id_ijin,nama_santri,nama_pengurus,tujuan_ijin,waktu_rebuild,waktu_keluar,waktu_kembali,status_ijin,created_at",false,"id_ijin",url("pengurus/ijin/"));
        return response()->json($json);
      }
      return view("pengurus.ijin.home",["title"=>"Data Perijinan Santri"]);
    }
    public function tambah()
    {
      return view("pengurus.ijin.form",["title"=>"Tambah Perijinan"]);
    }
    public function tambah_aksi(Request $req)
    {
      $this->validate($req,[
        "id_santri"=>"required",
        "tujuan_ijin"=>"required|min:1",
        "waktu_start"=>"required",
        "waktu_end"=>"required|after:waktu_start",
      ]);
      $pengurus = \Sitren\PengurusModel::where(["id"=>auth()->user()->id])->first();
      $id = $pengurus->id_pengurus;
      $data = $req->all();
      $data["id_pengurus"] = $id;
      $create = IjinModel::create($data);
      if ($create) {
        return back()->with("msg","Data Tersimpan");
      }else {
        return back()->withError("msg","Data Tidak Tersimpan");
      }
    }
    public function daftar($id)
    {
      $get = \Sitren\IjinModel::where(["id_ijin"=>$id]);
      if ($get->count() > 0) {
        $data = $get->first();
        return view("pengurus.ijin.form",["title"=>"Perijinan No [{$data->id_ijin}]","data"=>$data]);
      }else {
        return back();
      }
    }
    public function daftar_aksi(Request $req, $id,$tipe)
    {
      $set = IjinModel::find($id);
      $set->status_ijin = $tipe;
      if ($set->save()) {
        return back()->with("msg","Update Status Sukses");
      }else {
        return back()->withError("msg","Update Status Gagal");
      }
    }
    public function cetak($id)
    {
      $get = \Sitren\IjinModel::where(["id_ijin"=>$id]);
      if ($get->count() > 0) {
        $row = $get->first();
        $data = [
          'ijin' => $row,
      	];
      	$pdf = PDF::loadView('letter.struk', $data);
      	return $pdf->stream('struk.pdf');
      }else {
        return back();
      }
    }
}
