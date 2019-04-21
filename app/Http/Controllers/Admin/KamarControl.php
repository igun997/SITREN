<?php

namespace Sitren\Http\Controllers\Admin;
use Sitren\KamarModel;
use Illuminate\Http\Request;
use Sitren\Imports\ImportsKamar;
use Maatwebsite\Excel\Facades\Excel;
use Sitren\Http\Controllers\Controller;

class KamarControl extends Controller
{
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $data = KamarModel::all();
      $json = datatables($data,"nama_kamar,asrama,created_at,updated_at",true,"id_kamar",url("admin/kamar/"));
      return response()->json($json);
    }
    return view("admin.kamar.home",["title"=>"Data Kamar"]);
  }
  public function tambah()
  {
    return view("admin.kamar.form",["title"=>"Tambah Kamar"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
        'nama_kamar' => 'required|max:50|min:1',
        'asrama' => 'required'
    ]);

    $create = KamarModel::create($req->all());
    if ($create) {
      return back()->with('msg','Tambah Kamar Sukses');
    }else {
      return back()->withError('msg','Tambah Kamar Gagal');
    }
  }
  public function edit($id)
  {
    $get = KamarModel::where(["id_kamar"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.kamar.form",["title"=>"Edit Kamar [{$data->nama_kamar}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
        'nama_kamar' => 'required|max:50|min:1',
        'asrama' => 'required'
    ]);
    $set = KamarModel::find($id);
    $set->nama_kamar = $req->input("nama_kamar");
    $set->asrama = $req->input("asrama");
    if ($set->save()) {
      return back()->with("msg","Sukses Ubah Data");
    }else {
      return back()->withError("msg","Gagal Ubah Data");
    }
  }
  public function hapus($id)
  {
    $set = KamarModel::find($id)->delete();
    return back();
  }
  public function import()
  {
    return view("admin.kamar.import",["title"=>"Import Data Kamar"]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsKamar, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
