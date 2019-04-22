<?php

namespace Sitren\Http\Controllers\Bmt;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use PDF;
class LaporanControl extends Controller
{
    public function index()
    {
      return view("bmt.laporan.home",["title"=>"Laporan BMT"]);
    }
    public function index_aksi(Request $req)
    {
      $this->validate($req,[
        "start"=>"required",
        "end"=>"required|after:start",
      ]);
      if ($req->input("jenis") == "per_nasabah") {
        $get = \Sitren\TransaksiModel::orderBy("created_at","desc")->groupBy("id_santri");
        if ($get->count() < 1) {
          return back();
        }
        $data = [
          'row' => $get->get(),
          'req'=>$req
        ];
        $pdf = PDF::loadView('letter.cetak_per_tabungan', $data);
        return $pdf->stream('tabungan_per_nasabah.pdf');
      }elseif ($req->input("jenis") == "per_aktivitas") {
        $data = [
          'req'=>$req
        ];
        $pdf = PDF::loadView('letter.cetak_aktivitas', $data);
        return $pdf->stream('cetak_aktivitas.pdf');
      }elseif ($req->input("jenis") == "pendapatan") {
        $data = [
          'req'=>$req
        ];
        $pdf = PDF::loadView('letter.cetak_pendapatan', $data);
        return $pdf->stream('cetak_pendapatan.pdf');
      }else {
        return back();
      }
    }
}
