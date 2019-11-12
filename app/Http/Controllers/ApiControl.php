<?php

namespace Sitren\Http\Controllers;

use Illuminate\Http\Request;
use \Sitren\{TransaksiModel,Santri};
class ApiControl extends Controller
{
  public function savetrx(Request $req,$id)
  {
    $this->validate($req,[
      "jumlah"=>"required"
    ]);
    $data = $req->all();
    unset($data["_token"]);
    // $jenis = $data["asal"];
    // unset($data["asal"]);
    $getPengurus = \Sitren\PengurusModel::where(["id"=>auth()->user()->id])->first();
    $data["id_pengurus"] = $getPengurus->id_pengurus;
    $data["id_transaksi"] = genbmt_masuk();
    $data["id_santri"] = $id;
    if ($data["jenis"] == 0) {
      $data["jenis"] = "masuk";
    }else {
      $data["jenis"] = "keluar";
    }
    $createtrx = \Sitren\TransaksiModel::create($data);
    if ($createtrx) {
      return response()->json(["status"=>200,"msg"=>"Data Transaksi Tersimpan"]);
    }else {
      return response()->json(["status"=>500,"msg"=>"Data Gagal Transaksi Tersimpan"]);
    }
  }
  public function getInfoSantri($id)
  {
    $x = Santri::where(["id_santri"=>$id]);
    if ($x->count() > 0) {
      $xs = $x->first();
      $kamar = ((count($xs->assign_kamars) > 0)?$xs->assign_kamars[0]->kamar->nama_kamar:" - ");
      $kelas = ((count($xs->assign_kelas) > 0)?$xs->assign_kelas[0]->kela->nama_kelas:" - ");
      $infosantri = [];
      $xs->kelas_kamar = $kelas." / ".$kamar;
      $infosantri["data_diri"] = $xs;
      $infosantri["data_bmt"] = [];
      $plus = [];
      $min = [];
      foreach ($xs->transaksis as $key => $value) {
        if ($value->jenis == "masuk") {
          $plus[] = $value->jumlah;
        }elseif($value->jenis == "keluar" || $value->jenis == "biaya_transfer" || $value->jenis == "biaya_admin") {
          $min[] = $value->jumlah;
        }
      }
      if (count($plus) < 1) {
        $plus = 0;
      }
      if (count($min) < 1) {
        $min = 0;
      }
      if ($plus != 0) {
        $plus = array_sum($plus);
      }
      if ($plus != 0) {
        $min = array_sum($min);
      }
      $total = ($plus - $min);
      $infosantri["data_bmt"]["total_tabungan"] = number_format($total);
      $infosantri["data_bmt"]["total_tabungan_unformat"] =($total);
      return response()->json(["status"=>200,"data"=>$infosantri]);
    }else {
      return response()->json(["status"=>404,"msg"=>"Data Santri Tidak Ditemukan"]);
    }
  }
  public function getTabunganBySantri($id)
  {
    $cek = TransaksiModel::where(["id_santri"=>$id])->orderBy("created_at","desc");
    $data = [];
    $data["data"] = [];
    foreach ($cek->get() as $key => $value) {
      if ($value->jenis == "masuk") {
        $icon = "<label class='label label-success'>Masuk</badge>";
      }elseif ($value->jenis == "keluar") {
        $icon = "<label class='label label-danger'>Keluar</badge>";
      }elseif ($value->jenis == "biaya_admin") {
        $icon = "<label class='label label-danger'>ADM</badge>";
      }elseif ($value->jenis == "biaya_transfer") {
        $icon = "<label class='label label-danger'>BT</badge>";
      }
      $data["data"][] = [($key+1),$icon,number_format($value->jumlah),$value->keterangan,$value->pengurus->pegawai->nama_pegawai,date("d-m-Y H:i:s",strtotime($value->created_at))];
    }
    return response()->json($data);
  }
}
