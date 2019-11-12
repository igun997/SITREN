<?php

namespace Sitren\Http\Controllers;

use Illuminate\Http\Request;
use \Sitren\TransaksiModel;
class ApiControl extends Controller
{
  public function getTabunganBySantri($id)
  {
    $cek = TransaksiModel::where(["id_santri"=>$id])->orderBy("created_at","desc");
    $data = [];
    $data["data"] = [];
    foreach ($cek->get() as $key => $value) {
      $data["data"][] = [$value->jenis,$value->jumlah,$value->keterangan,$value->pengurus->pegawai->nama_pegawai,date("d-m-Y")];
    }
    return response()->json($data);
  }
}
