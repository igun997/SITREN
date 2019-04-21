<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use Sitren\KatinfraModel;
use Sitren\Imports\ImportsKatinfra;
use Maatwebsite\Excel\Facades\Excel;
class KatinfraControl extends Controller
{
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $data = KatinfraModel::all();
      $json = datatables($data,"nama_katinfra,created_at,updated_at",true,"id_katinfra",url("admin/katinfra/"));
      return response()->json($json);
    }
    return view("admin.katinfra.home",["title"=>"Data Kategori Infrastruktur"]);
  }
  public function tambah()
  {
    return view("admin.katinfra.form",["title"=>"Tambah Kategori Infrastruktur"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
        'nama_katinfra' => 'required|max:50|min:1',
    ]);

    $create = KatinfraModel::create($req->all());
    if ($create) {
      return back()->with('msg','Tambah Kategori Sukses');
    }else {
      return back()->withError('msg','Tambah Kategori Gagal');
    }
  }
  public function edit($id)
  {
    $get = KatinfraModel::where(["id_katinfra"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.katinfra.form",["title"=>"Edit Kategori [{$data->nama_katinfra}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
        'nama_katinfra' => 'required|max:50|min:1',

    ]);
    $set = KatinfraModel::find($id);
    $set->nama_katinfra = $req->input("nama_katinfra");
    if ($set->save()) {
      return back()->with("msg","Sukses Ubah Data");
    }else {
      return back()->withError("msg","Gagal Ubah Data");
    }
  }
  public function hapus($id)
  {
    $set = KatinfraModel::find($id)->delete();
    return back();
  }
  public function import()
  {
    return view("admin.katinfra.import",["title"=>"Import Data Kategori"]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsKatinfra, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
