<?php

namespace Sitren\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class PenerapanControl extends Controller
{
    public function kelas()
    {
      return view("admin.penerapan.kelas.home",["title"=>"Penerapan Kelas","no"=>1]);
    }
    public function setkelas($id)
    {
      return view("admin.penerapan.kelas.form",["title"=>"Tambah Santri Kelas","no"=>1,"id"=>$id]);
    }
    public function setkelas_aksi(Request $req,$id)
    {
      $this->validate($req,
        [
          "id_santri"=>"required|unique:assign_kelas|min:1"
        ]
      );
      $data = $req->all();
      $data["id_kelas"] = $id;
      $create = \Sitren\AssignKelas::create($data);
      if ($create) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withError("msg","Data Gagal Di Simpan");
      }
    }
    public function unsetkelas_aksi($id,$del)
    {
      $del = \Sitren\AssignKelas::find($del)->delete();
      return back();
    }
    public function kamar()
    {
      return view("admin.penerapan.kamar.home",["title"=>"Penerapan Kamar","no"=>1]);
    }
    public function setkamar($id)
    {
      return view("admin.penerapan.kamar.form",["title"=>"Tambah Santri Kamar","no"=>1,"id"=>$id]);
    }
    public function setkamar_aksi(Request $req,$id)
    {
      $this->validate($req,
        [
          "id_santri"=>"required|unique:assign_kamar|min:1"
        ]
      );
      $data = $req->all();
      $data["id_kamar"] = $id;
      $create = \Sitren\AssignKamar::create($data);
      if ($create) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withError("msg","Data Gagal Di Simpan");
      }
    }
    public function unsetkamar_aksi($id,$del)
    {
      $del = \Sitren\AssignKamar::find($del)->delete();
      return back();
    }
    public function walikamar()
    {
      return view("admin.penerapan.walikamar.home",["title"=>"Penerapan Walikamar","no"=>1]);
    }
    public function setwalikamar($id)
    {
      return view("admin.penerapan.walikamar.form",["title"=>"Tambah Walikamar","no"=>1,"id"=>$id]);
    }
    public function setwalikamar_aksi(Request $req,$id)
    {
      $this->validate($req,
        [
          "id_pengurus"=>"required|unique:assign_walikamar|min:1"
        ]
      );
      $data = $req->all();
      $data["id_kamar"] = $id;
      $create = \Sitren\AssignWalikamar::create($data);
      if ($create) {
        return back()->with("msg","Data Sukses Di Simpan");
      }else {
        return back()->withError("msg","Data Gagal Di Simpan");
      }
    }
    public function unsetwalikamar_aksi($id,$del)
    {
      $del = \Sitren\AssignWalikamar::find($del)->delete();
      return back();
    }
}
