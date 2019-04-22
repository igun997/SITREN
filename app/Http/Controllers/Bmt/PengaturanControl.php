<?php

namespace Sitren\Http\Controllers\Bmt;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class PengaturanControl extends Controller
{
    public function index()
    {
      $admin = \Sitren\SettingModel::where(["meta_key"=>"biaya_admin"]);
      $tf = \Sitren\SettingModel::where(["meta_key"=>"biaya_transfer"]);
      return view("bmt.pengaturan.home",["title"=>"Pengaturan BMT","tf"=>$tf,"admin"=>$admin]);
    }
    public function index_aksi(Request $req)
    {
      $this->validate($req,[
        "biaya_admin"=>"required|numeric",
        "biaya_transfer"=>"required|numeric",
      ]);
      $tf = $req->input("biaya_transfer");
      $admin = $req->input("biaya_admin");
      $setAdmin = \Sitren\SettingModel::where(["meta_key"=>"biaya_admin"])->update(["meta_value"=>$admin]);
      $setTf = \Sitren\SettingModel::where(["meta_key"=>"biaya_transfer"])->update(["meta_value"=>$tf]);
      if ($setAdmin || $setTf) {
        return back()->with("msg","Data Berhasil Di Simpan");
      }else {
        return back()->withErrors(["error"=>"Gagal Simpan Data"]);
      }
    }
}
