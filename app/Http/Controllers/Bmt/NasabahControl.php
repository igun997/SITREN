<?php

namespace Sitren\Http\Controllers\Bmt;

use Illuminate\Http\Request;
use Sitren\Http\Controllers\Controller;
use DB;
use PDF;
class NasabahControl extends Controller
{
    public function index()
    {
      $loopcast = \Sitren\TransaksiModel::groupBy('id_santri')
       ->selectRaw('sum(jumlah) as jml,transaksi.*')
       ->get();
      return view("bmt.nasabah.home",["title"=>"Data Nasabah","data"=>$loopcast]);
      // return response()->json($loopcast);
    }
    public function view($id=null)
    {
      $get = \Sitren\TransaksiModel::orderBy("created_at","desc")->where(["id_santri"=>$id]);
      $getLoop = \Sitren\TransaksiModel::orderBy("created_at","desc")->where(["id_santri"=>$id]);
      if ($get->count() < 1) {
        return back();
      }else {
        $data = $get->first();
        $loopcast = $getLoop->get();
        return view("bmt.nasabah.view",["title"=>"Detail Nasabah [{$data->santri->nama_lengkap}]","data"=>$data,"loop"=>$loopcast]);
      }
    }
    public function print($id='')
    {
      $get = \Sitren\TransaksiModel::orderBy("created_at","desc")->where(["id_santri"=>$id]);
      $getList = \Sitren\TransaksiModel::orderBy("created_at","desc")->where(["id_santri"=>$id]);
      if ($get->count() < 1) {
        return back();
      }
      $row = $get->first();
      $data = [
        'row' => $row,
        'list'=>$getList->get()
      ];
      $pdf = PDF::loadView('letter.cetak_tabungan', $data);
      return $pdf->stream('tabungan.pdf');
    }
}
