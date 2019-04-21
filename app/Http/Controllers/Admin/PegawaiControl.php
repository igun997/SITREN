<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use Sitren\PegawaiModel;
use Sitren\Imports\ImportsPegawai;
use Maatwebsite\Excel\Facades\Excel;
class PegawaiControl extends Controller
{
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $data = PegawaiModel::all();
      $json = datatables($data,"nama_pegawai,jk,alamat,email,notelp,created_at,updated_at",true,"id_pegawai",url("admin/pegawai/"));
      return response()->json($json);
    }
    return view("admin.pegawai.home",["title"=>"Data Pegawai"]);
  }
  public function tambah()
  {
    return view("admin.pegawai.form",["title"=>"Tambah Pegawai"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
      'nama_pegawai' => 'required|max:50|min:1',
      'jk' => 'required|max:50|min:1',
      'alamat' => 'required|max:50|min:1',
      'email' => 'max:50|min:1',
      'notelp' => 'required|max:50|min:1',
    ]);

    $create = PegawaiModel::create($req->all());
    if ($create) {
      return back()->with('msg','Tambah Pegawai Sukses');
    }else {
      return back()->withError('msg','Tambah Pegawai Gagal');
    }
  }
  public function edit($id)
  {
    $get = PegawaiModel::where(["id_pegawai"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.pegawai.form",["title"=>"Edit Pegawai [{$data->nama_pegawai}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
      'nama_pegawai' => 'required|max:50|min:1',
      'jk' => 'required|max:50|min:1',
      'alamat' => 'required|max:50|min:1',
      'email' => 'max:50|min:1',
      'notelp' => 'required|max:50|min:1',
    ]);
    $data = $req->all();
    unset($data["_token"]);
    $set = PegawaiModel::where(["id_pegawai"=>$id])->update($data);
    if ($set) {
      return back()->with("msg","Sukses Ubah Data");
    }else {
      return back()->withError("msg","Gagal Ubah Data");
    }
  }
  public function hapus($id)
  {
    $set = PegawaiModel::find($id)->delete();
    return back();
  }
  public function import()
  {
    return view("admin.pegawai.import",["title"=>"Import Data Pegawai"]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsPegawai, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
