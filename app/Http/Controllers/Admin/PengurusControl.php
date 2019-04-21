<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Sitren\Http\Controllers\Controller;
use Sitren\PengurusModel;
class PengurusControl extends Controller
{
  public function __construct()
  {
    $this->middleware('transaction', ['only'=>'tambah_aksi']);
  }
  public function index(Request $req)
  {
    if ($req->ajax()) {
      $tipe = $req->input("type");
      $recompos = function($res,$tipe){
        $no = 1;
        foreach ($res as $key => &$value) {
          $value->no = $no++;
          if ($tipe == "pegawai") {
            $value->nama_lengkap = $value->pegawai->nama_pegawai;
          }else {
            $value->nama_lengkap = $value->santri->nama_lengkap;
          }
          $value->username = $value->user->name;
          $value->email = $value->user->email;
          $value->level = ucfirst($value->user->level);
        }
        return $res;
      };
      if ($tipe == "santri") {
        $data = PengurusModel::whereNotNull("id_santri")->get();
      }else {
        $data = PengurusModel::whereNotNull("id_pegawai")->get();
      }
      $data = $recompos($data,$tipe);
      $json = datatables($data,"no,nama_lengkap,username,email,level,created_at,updated_at",false,"id_pengurus",url("admin/pengurus/"));
      return response()->json($json);
    }
    return view("admin.pengurus.home",["title"=>"Data Pengurus"]);
  }
  public function tambah()
  {
    return view("admin.pengurus.form",["title"=>"Tambah Pengurus"]);
  }
  public function tambah_aksi(Request $req)
  {
    $validator = $req->validate([
      'name' => 'required|max:50|min:1',
      'email' => 'required|max:50|min:1',
      'level' => 'required|max:50|min:1',
      'password' => 'required|max:255|min:1',
    ]);
    $data = $req->all();
    unset($data["_token"]);
    foreach ($data as $key => &$value) {
      if ($value == "") {
        unset($data[$key]);
      }
    }
    $user = ["name"=>$data["name"],"email"=>$data["email"],"level"=>$data["level"],"password"=>Hash::make($data['password'])];
    $cuser = \Sitren\User::create($user);
    foreach ($data as $key => &$value) {
      foreach ($user as $k => $v) {
        if ($k == $key) {
          unset($data[$key]);
        }
      }
    }
    $data["id"] = $cuser->id;
    $create = PengurusModel::create($data);
    if ($create) {
      return back()->with('msg','Tambah  Sukses');
    }else {
      return back()->withError('msg','Tambah  Gagal');
    }
  }
  public function edit($id)
  {
    $get = PengurusModel::where(["id_pengurus"=>$id]);
    if ($get->count() > 0) {
      $data = $get->first();
      return view("admin.pengurus.form",["title"=>"Edit  [{$data->user->name}]","data"=>$data]);
    }else {
      return back();
    }
  }
  public function edit_aksi(Request $req, $id)
  {
    $validator = $req->validate([
      'name' => 'required|max:50|min:1',
      'email' => 'required|max:50|min:1',
      'level' => 'required|max:50|min:1',
    ]);
    $data = $req->all();
    $id_user = $data["id"];
    unset($data["_token"]);
    unset($data["id"]);
    foreach ($data as $key => &$value) {
      if ($value == "") {
        unset($data[$key]);
      }
    }
    if (isset($data['password'])) {
      $user = ["name"=>$data["name"],"email"=>$data["email"],"level"=>$data["level"],"password"=>Hash::make($data['password'])];
    }else {
      $user = ["name"=>$data["name"],"email"=>$data["email"],"level"=>$data["level"]];
    }
    $cuser = \Sitren\User::where(["id"=>$id_user])->update($user);
    foreach ($data as $key => &$value) {
      foreach ($user as $k => $v) {
        if ($k == $key) {
          unset($data[$key]);
        }
      }
    }
    if (@$data["id_pegawai"] != null) {
      $data["id_santri"] = null;
    }else {
      $data["id_pegawai"] = null;
    }
    $data["id"] = $id_user;
    $create = PengurusModel::where(["id_pengurus"=>$id])->update($data);
    if ($create) {
      return back()->with('msg','Ubah Sukses');
    }else {
      return back()->withError('msg','Ubah Gagal');
    }
  }
  public function hapus($id)
  {
    $find = PengurusModel::where(["id_pengurus"=>$id])->first();
    $set = \Sitren\User::find($find->id)->delete();
    return back();
    // return $find->id_pengurus;
  }
  public function import()
  {
    return view("admin.pengurus.import",["title"=>"Import Data "]);
  }
  public function import_aksi(Request $req)
  {
    $req->validate([
      "file"=>"mimes:xls,csv,xlsx|required"
    ]);
    $path = $req->file('file')->getRealPath();
    $data = Excel::import(new ImportsPengurus, $path);
    if ($data) {
      return back()->with('msg', 'Import Berhasil');
    }else {
      return back()->withError('msg', 'Import Gagal');
    }
  }
}
