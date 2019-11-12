<?php

namespace Sitren\Http\Controllers\Bmt;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use PDF;
class TransaksiControl extends Controller
{
    public function index()
    {
      $get = \Sitren\TransaksiModel::orderBy('created_at', 'desc')->get();
      return view("bmt.transaksi.home",["title"=>"Transaksi","data"=>$get]);
    }
    public function setor($id=null)
    {
      if ($id != null) {
        $get = \Sitren\SantriModel::where(["id_santri"=>$id]);
        if ($get->count() < 1) {
          return redirect("bmt/transaksi");
        }
        $get = $get->first();
        return view("bmt.transaksi.form_setor",["title"=>"Setor Tunai Nasabah [{$get->id_santri} - {$get->nama_lengkap}]","jenis"=>"setor","data"=>$get]);
      }else {
        return view("bmt.transaksi.form",["title"=>"Pilih Nasabah","jenis"=>"setor"]);
      }
    }
    public function setor_aksi(Request $req)
    {
      $this->validate($req,[
        "jumlah"=>"required"
      ]);
      $data = $req->all();
      // $jenis = $data["asal"];
      // unset($data["asal"]);
      $getPengurus = \Sitren\PengurusModel::where(["id"=>auth()->user()->id])->first();
      $data["id_pengurus"] = $getPengurus->id_pengurus;
      $data["id_transaksi"] = genbmt_masuk();
      $createtrx = \Sitren\TransaksiModel::create($data);
      if ($createtrx) {
        // if ($jenis == "transfer") {
          // $copy = $data;
          // $getbiaya = \Sitren\SettingModel::where(["meta_key"=>"biaya_transfer"])->first()->meta_value;
          // $copy["id_transaksi"] = genbmt_masuk();
          // $copy["jumlah"] = $getbiaya;
          // $copy["jenis"] = "biaya_transfer";
          // if ( !(\Sitren\TransaksiModel::create($copy))) {
          //   \Sitren\TransaksiModel::find($data["id_transaksi"])->delete();
          //   return back()->withError("msg","Biaya Admin Tidak Bisa Dimasukan");
          // }
        // }
        return back()->with("msg","Data Transaksi Tersimpan");
      }else {
        return back()->withErrors(["error"=>"Gagal Menyimpan Data"]);
      }
    }
    public function tarik($id=null)
    {
      if ($id != null) {
        $get = \Sitren\SantriModel::where(["id_santri"=>$id]);
        if ($get->count() < 1) {
          return redirect("bmt/transaksi");
        }
        $get = $get->first();
        return view("bmt.transaksi.form_tarik",["title"=>"Tarik Tunai Nasabah [{$get->id_santri} - {$get->nama_lengkap}]","jenis"=>"tarik","data"=>$get]);
      }else {
        return view("bmt.transaksi.form",["title"=>"Pilih Nasabah","jenis"=>"tarik"]);
      }
    }
    public function tarik_aksi(Request $req)
    {
      $this->validate($req,[
        "jumlah"=>"required"
      ]);
      $data = $req->all();
      $getPengurus = \Sitren\PengurusModel::where(["id"=>auth()->user()->id])->first();
      $total = (\Sitren\TransaksiModel::where(["id_santri"=>$data["id_santri"],"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data["id_santri"],"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data["id_santri"],"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data["id_santri"],"jenis"=>"biaya_transfer"])->sum("jumlah"));
      if ($total >= $data["jumlah"]) {
        $data["id_pengurus"] = $getPengurus->id_pengurus;
        $data["id_transaksi"] = genbmt_keluar();
        $createtrx = \Sitren\TransaksiModel::create($data);
        if ($createtrx) {
          return back()->with("msg","Data Transaksi Tersimpan");
        }else {
          return back()->withErrors(["error"=>"Gagal Menyimpan Data"]);
        }
      }else {
        return back()->withErrors(["error"=>"Maaf Saldo Nasabah Kurang"]);
      }
    }
    public function cetak($id='')
    {
      $get = \Sitren\TransaksiModel::orderBy("created_at","desc")->where(["id_transaksi"=>$id]);
      if ($get->count() < 1) {
        return back();
      }
      $row = $get->first();
      $data = [
        'data' => $row,
      ];
      $pdf = PDF::loadView('letter.cetak_slip', $data);
      return $pdf->stream('slip_'.$row->id_transaksi.'.pdf');
    }
}
