<?php
function genid($jk="")
{
  if ($jk == "putra") {
    $jk = "01";
  }else {
    $jk = "02";
  }
  $obj = Sitren\SantriModel::all();
  $id = date("y").$jk.str_pad(($obj->count()+1),3,"0",STR_PAD_LEFT);
  return $id;
}
function genijin()
{
  $obj = Sitren\IjinModel::whereDay('created_at', '=', date('d'));
  $id = date("ymd").str_pad(($obj->count()+1),3,"0",STR_PAD_LEFT);
  return $id;
}
function genbmt_masuk()
{
  $obj = Sitren\TransaksiModel::whereDay('created_at', '=', date('d'));
  $id = "BMT-01-".date("ymd")."-".str_pad(($obj->count()+1),3,"0",STR_PAD_LEFT);
  return $id;
}
function genbmt_keluar()
{
  $obj = Sitren\TransaksiModel::whereDay('created_at', '=', date('d'));
  $id = "BMT-02-".date("ymd")."-".str_pad(($obj->count()+1),3,"0",STR_PAD_LEFT);
  return $id;
}
function getkamar($id)
{
  return  \Sitren\AssignKamar::where(["id_santri"=>$id])->first();
}
function getkelas($id)
{
  return  \Sitren\AssignKelas::where(["id_santri"=>$id])->first();
}
function datatables_pengurus($res=[],$select="",$autonum = true,$pk="",$url="",$view = false)
{
  $i =1;
  $data = [];
  $data["data"] = [];
  foreach ($res as $key => $value) {
    $inner = [];
    $exp = explode(",",$select);
    $c = count($exp);
    $ix = 1;
    foreach ($exp as $k => $v) {
      if ($autonum) {
        $inner[] = $i++;
      }
      if ($value["$v"] != null) {
        if ($v == "created_at" || $v == "updated_at" || $v == "tgl_lhr" || $v == "waktu_start" || $v == "waktu_end" || $v == "waktu_keluar" || $v == "waktu_kembali" ) {
          $cv = date("d-m-Y",strtotime($value["$v"]));
          $inner[] = $cv;
        }else {
          $inner[] = $value["$v"];
        }
      }else {
        $inner[] = $value["$v"];
      }
      if ($pk != "") {
        if ($ix++ == $c) {
          if ($view) {
            $inner[] = " <a href='".$url."/view/".$value["$pk"]."' class='btn btn-success'><li class='fa fa-search'></li></a> <a href='".$url."/cetak/".$value["$pk"]."' class='btn btn-primary'><li class='fa fa-print'></li></a> <a href='".$url."/daftar/".$value["$pk"]."' class='btn btn-primary'><li class='fa fa-list'></li></a>";
          }else {
            $inner[] = "<a href='".$url."/cetak/".$value["$pk"]."' class='btn btn-primary'><li class='fa fa-print'></li></a> <a href='".$url."/daftar/".$value["$pk"]."' class='btn btn-primary'><li class='fa fa-list'></li></a>";
          }
        }
      }
    }
    $data["data"][] = $inner;
  }
  return $data;
}

function datatables($res=[],$select="",$autonum = true,$pk="",$url="",$view = false)
{
  $i =1;
  $data = [];
  $data["data"] = [];
  foreach ($res as $key => $value) {
    $inner = [];
    $exp = explode(",",$select);
    $c = count($exp);
    $ix = 1;
    if ($autonum) {
      $inner[] = $i++;
    }
    foreach ($exp as $k => $v) {
      if ($v == "created_at" || $v == "updated_at" || $v == "tgl_lhr") {
        $cv = date("d-m-Y",strtotime($value["$v"]));
        $inner[] = $cv;
      }else {
        $inner[] = $value["$v"];
      }
      if ($pk != "") {
        if ($ix++ == $c) {
          if ($view) {
            $inner[] = " <a href='".$url."/edit/".$value["$pk"]."?type=view' class='btn btn-success'><li class='fa fa-search'></li></a> <a href='".$url."/edit/".$value["$pk"]."' class='btn btn-warning'><li class='fa fa-edit'></li></a> <a href='".$url."/hapus/".$value["$pk"]."' class='btn btn-danger'><li class='fa fa-trash'></li></a>";
          }else {
            $inner[] = "<a href='".$url."/edit/".$value["$pk"]."' class='btn btn-warning'><li class='fa fa-edit'></li></a> <a href='".$url."/hapus/".$value["$pk"]."' class='btn btn-danger'><li class='fa fa-trash'></li></a>";
          }
        }
      }
    }
    $data["data"][] = $inner;
  }
  return $data;
}
function select2($data=[],$op=[])
{
  $s = [];
  $s[] = ["text"=>"== Pilih ==","id"=>""];
  foreach ($data as $key => $value) {
    $s[] = ["text"=>$value[$op["text"]],"id"=>$value[$op["id"]]];
  }
  return $s;
}
function alpha()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pin = mt_rand(1000000, 9999999)
        . mt_rand(1000000, 9999999)
        . $characters[rand(0, strlen($characters) - 1)];
    $string = str_shuffle($pin);
    return $string;
}
function stylePack($type='style')
{
  $symbol = explode("symbol","\symbol");
  $symbol = $symbol[0];
  $baseassets = str_replace($symbol,"/",base_path())."/style/";
  if (!file_exists($baseassets.$type)) {
    exit("Default Style Wrong");
    die();
  }
  $readfile = file_get_contents($baseassets.$type);
  $readfile = explode("[CSS]",$readfile);
  $readfile = explode("[JS]",$readfile[1]);
  $css = explode("\n",$readfile[0]);
  $js = explode("\n",$readfile[1]);
  foreach ($js as $key => &$value) {
    if ($value == "" || $value == "\n" || $value == "\r") {
      unset($js[$key]);
    }
  }
  foreach ($css as $key => &$value) {
    if ($value == "" || $value == "\n" || $value == "\r") {
      unset($css[$key]);
    }
  }
  foreach ($css as $key => &$value) {
    $baseexp = explode("-|",$value);
    if (count($baseexp) > 1) {
      $value = '<link rel="stylesheet" href="'.url($baseexp[1]).'">';
    }else {
      $value = '<link rel="stylesheet" href="'.str_replace("\n","",$value).'">';
    }
  }
  foreach ($js as $key => &$value) {
    $baseexp = explode("-|",$value);
    if (count($baseexp) > 1) {
      $value = '<script src="'.url($baseexp[1]).'"></script>';
    }else {
      $value = '<script src="'.str_replace("\n","",$value).'"></script>';
    }
  }
  return ["css"=>implode("\n",$css),"js"=>implode("\n",$js)];
}
