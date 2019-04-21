<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use Sitren\InfraModel;
use Sitren\Imports\ImportsInfra;
use Maatwebsite\Excel\Facades\Excel;
class InfraControl extends Controller
{
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $data = InfraModel::all();
      foreach ($data as $key => $value) {
        $value->kategori = $value->katinfra->nama_katinfra;
      }
      $json = datatables($data,"nama_infra,kategori,created_at,updated_at",true,"id_infra",url("admin/infra/"));
      return response()->json($json);
    }
    return view("admin.infra.home",["title"=>"Data  Infrastruktur"]);
  }
  public function tambah()
  {
    return view("admin.infra.form",["title"=>"Tambah  Infrastruktur"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
        'nama_infra' => 'required|max:50|min:1',
    ]);

    $create = InfraModel::create($req->all());
    if ($create) {
      return back()->with('msg','Tambah  Sukses');
    }else {
      return back()->withError('msg','Tambah  Gagal');
    }
  }
  public function edit($id)
  {
    $get = InfraModel::where(["id_infra"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.infra.form",["title"=>"Edit  [{$data->nama_infra}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
        'nama_infra' => 'required|max:50|min:1',

    ]);
    $set = InfraModel::find($id);
    $set->nama_infra = $req->input("nama_infra");
    if ($set->save()) {
      return back()->with("msg","Sukses Ubah Data");
    }else {
      return back()->withError("msg","Gagal Ubah Data");
    }
  }
  public function hapus($id)
  {
    $set = InfraModel::find($id)->delete();
    return back();
  }
  public function import()
  {
    return view("admin.infra.import",["title"=>"Import Data "]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsInfra, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
