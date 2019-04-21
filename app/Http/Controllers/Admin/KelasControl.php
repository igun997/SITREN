<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use Sitren\KelasModel;
use Sitren\Imports\ImportsKelas;
use Maatwebsite\Excel\Facades\Excel;
class KelasControl extends Controller
{
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $data = KelasModel::all();
      $json = datatables($data,"nama_kelas,jenis,created_at,updated_at",true,"id_kelas",url("admin/kelas/"));
      return response()->json($json);
    }
    return view("admin.kelas.home",["title"=>"Data Kelas"]);
  }
  public function tambah()
  {
    return view("admin.kelas.form",["title"=>"Tambah Kelas"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
        'nama_kelas' => 'required|max:50|min:1',
        'jenis' => 'required'
    ]);

    $create = KelasModel::create($req->all());
    if ($create) {
      return back()->with('msg','Tambah Kelas Sukses');
    }else {
      return back()->withError('msg','Tambah Kelas Gagal');
    }
  }
  public function edit($id)
  {
    $get = KelasModel::where(["id_kelas"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.kelas.form",["title"=>"Edit Kelas [{$data->nama_kelas}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
        'nama_kelas' => 'required|max:50|min:1',
        'jenis' => 'required'
    ]);
    $set = KelasModel::find($id);
    $set->nama_kelas = $req->input("nama_kelas");
    $set->jenis = $req->input("jenis");
    if ($set->save()) {
      return back()->with("msg","Sukses Ubah Data");
    }else {
      return back()->withError("msg","Gagal Ubah Data");
    }
  }
  public function hapus($id)
  {
    $set = KelasModel::find($id)->delete();
    return back();
  }
  public function import()
  {
    return view("admin.kelas.import",["title"=>"Import Data Kelas"]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsKelas, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
