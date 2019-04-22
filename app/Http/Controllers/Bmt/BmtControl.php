<?php

namespace Sitren\Http\Controllers\Bmt;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;

class BmtControl extends Controller
{
    public function index()
    {
      return view("bmt.home",["title"=>"Dashboard BMT"]);
    }
    public function trigger()
    {
      if (date("d") == 1) {
        $fetch = \Sitren\TransaksiModel::groupBy("id_santri")->get();
        $biaya_admin = \Sitren\SettingModel::where(["meta_key"=>"biaya_admin"])->first()->meta_value;
        $getPengurus = \Sitren\PengurusModel::where(["id"=>auth()->user()->id])->first();
        $id = $getPengurus->id_pengurus;
        foreach ($fetch as $key => $value) {
          \Sitren\TransaksiModel::create(["id_transaksi"=>genbmt_keluar(),"id_santri"=>$value->id_santri,"jenis"=>"biaya_admin","jumlah"=>$biaya_admin,"id_pengurus"=>$id,"keterangan"=>"Pemotongan Biaya Administrasi"]);
        }
        return back()->with("msg","Eksekusi Sukses");
      }else {
        return back()->withErrors(['error'=>"Gagal Eksekusi Biaya Admin, Eksekusi Dilakukan Setiap Tanggal 1 Di Awal Bulan"]);
      }
    }
}
