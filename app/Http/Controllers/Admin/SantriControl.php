<?php

namespace Sitren\Http\Controllers\Admin;
use Sitren\SantriModel;
use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class SantriControl extends Controller
{
    public function index(Request $req)
    {
      if ($req->ajax()) {
        $data = SantriModel::all();
        $json = datatables($data,"id_santri,nama_lengkap,tmpt_lhir,tgl_lhr,created_at,updated_at",true,"id_santri",url("admin/santri/"),true);
        return response()->json($json);
      }
      return view("admin.santri.home",["title"=>"Data Santri"]);
    }
    public function tambah(Request $req)
    {
      return view("admin.santri.form",["title"=>"Tambah Santri","req"=>$req]);
    }
    public function tambah_aksi(Request $req)
    {
      $validator = $req->validate([
        'nama_lengkap' => 'required|min:1',
        'jenis_kelamin' => 'required|min:1',
        'tmpt_lhir' => 'required|min:1',
        'tgl_lhr' => 'required|min:1',
        'status_keluarga' => 'required|min:1',
        'bahasa_harian' => 'required|min:1',
      ]);

      $create = SantriModel::create($req->all());
      if ($create) {
        return back()->with('msg','Tambah Santri Sukses');
      }else {
        return back()->withError('msg','Tambah Santri Gagal');
      }
    }
    public function edit(Request $req,$id)
    {
      $get = SantriModel::where(["id_santri"=>$id]);
      if ($get->count() > 0) {
        $penghasilan = function($s){
          if ($s == "<1") {
            return "< 1.000.000";
          }elseif ($s == "1-2.5") {
            return "1.000.000 - 2.500.000";
          }elseif ($s == "2.5-5") {
            return "2.500.000 - 5.000.000";
          }elseif ($s == "5-10") {
            return "5.000.000 - 10.00.000";
          }elseif ($s == "10>") {
            return "10.00.000 >";
          }
        };
        $data = $get->first();
        $data->penghasilan_ayah_string = $penghasilan($data->penghasilan_ayah);
        $data->penghasilan_ibu_string = $penghasilan($data->penghasilan_ibu);
        return view("admin.santri.form",["title"=>"Edit Santri [{$data->nama_lengkap}]","data"=>$data,"req"=>$req]);
      }else {
        return back();
      }
    }
    public function edit_aksi(Request $req, $id)
    {
      $validator = $req->validate([
        'nama_lengkap' => 'required|min:1',
        'jenis_kelamin' => 'required|min:1',
        'tmpt_lhir' => 'required|min:1',
        'tgl_lhr' => 'required|min:1',
        'status_keluarga' => 'required|min:1',
        'bahasa_harian' => 'required|min:1',
      ]);
      $data = $req->all();
      unset($data["_token"]);
      $set = SantriModel::where(["id_santri"=>$id])->update($data);
      if ($set) {
        return back()->with("msg","Sukses Ubah Data");
      }else {
        return back()->withError("msg","Gagal Ubah Data");
      }
    }
    public function hapus($id)
    {
      $set = SantriModel::find($id)->delete();
      return back();
    }
    public function import()
    {
      return view("admin.santri.import",["title"=>"Import Data Santri"]);
    }
    public function import_aksi(Request $req)
    {
      $req->validate([
        "file"=>"mimes:xls,csv,xlsx|required"
      ]);
      $path = $req->file('file')->getRealPath();
      $data = Excel::import(new ImportsSantri, $path);
      if ($data) {
        return back()->with('msg', 'Import Berhasil');
      }else {
        return back()->withError('msg', 'Import Gagal');
      }
    }
}
