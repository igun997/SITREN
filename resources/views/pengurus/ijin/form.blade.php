@extends('adminlte::page')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
    <div class="box">
      <div class="box-header">
        <div class="box-title">
          {{$title}}
        </div>
      </div>
      <div class="box-body">
        <div class="col-md-12">
          @if($errors->any())
          <div class="alert alert-danger">
              @foreach($errors->all() as $key => $value)
              <p>{{$value}}</p>
              @endforeach
          </div>
          @endif
          @if(\Session::has("msg"))
          <div class="alert alert-success">{{session("msg")}}</div>
          @endif
          <form class="form-horizontal"  action="" method="post">
            @csrf
            <div class="form-group">
              <label>Nomor Ijin</label>
              <input type="text" readonly name="id_ijin" class="form-control" value="{{genijin()}}">
            </div>
            <div class="form-group">
              <label>Nama Santri</label>
              <select class="form-control" name="id_santri">
                <option value="">== Pilih Santri ==</option>
                @foreach(\Sitren\SantriModel::all() as $k => $v)
                  @if(@$data->santri->id_santri)
                  <option value="{{$v->id_santri}}" selected>{{$v->id_santri}} - {{$v->nama_lengkap}}</option>
                  @else
                  <option value="{{$v->id_santri}}">{{$v->id_santri}} - {{$v->nama_lengkap}}</option>
                  @endif
                @endforeach;
              </select>
            </div>

            <div class="form-group">
              <label>Tujuan Ijin</label>
              <textarea name="tujuan_ijin" class="form-control" rows="8" cols="80">{{@$data->tujuan_ijin}}</textarea>
            </div>
            <div class="form-group">
              <label>Ijin Dari</label>
              <input type="text" name="waktu_start" value="{{@date("Y-m-d H:i:s",strtotime($data->waktu_start))}}" class="form-control dt" >
            </div>
            <div class="form-group">
              <label>Ijin Sampai</label>
              <input type="text" name="waktu_end"value="{{@date("Y-m-d H:i:s",strtotime($data->waktu_end))}}" class="form-control dt" >
            </div>
            @if(isset($data->id_ijin))
            <div class="form-group">
              <label>Waktu Keluar</label>
              <input type="text" name="waktu_keluar" value="{{($data->waktu_keluar != null)?date("Y-m-d H:i:s",strtotime($data->waktu_keluar)):""}}" class="form-control dt" >
            </div>
            <div class="form-group">
              <label>Waktu Kembali</label>
              <input type="text" name="waktu_masuk"value="{{($data->waktu_masuk != null)?date("Y-m-d H:i:s",strtotime($data->waktu_masuk)):""}}" class="form-control dt" >
            </div>
            <div class="form-group">
              <label>Status Ijin</label>
              <p class='btn btn-info'>{{ucfirst($data->status_ijin)}}</p>
            </div>
            @endif
            @if(!isset($data->id_ijin))
            <div class="form-group">
              <button type="reset" class="btn btn-danger">
                Reset
              </button>
              <button type="submit" class="btn btn-success">
                Simpan
              </button>
            </div>
            @endif
          </form>
          @if(isset($data->id_ijin))
          <form class="form-horizontal" action="" method="post">
            <div class="form-group">
              <a href="{{url("pengurus/ijin/daftar/".$data->id_ijin."/dibatalkan")}}" class="btn btn-danger">Batalkan Ijin</a>
              <a href="{{url("pengurus/ijin/daftar/".$data->id_ijin."/selesai")}}" class="btn btn-success">Selesaikan Ijin</a>
            </div>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" />
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js" charset="utf-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" charset="utf-8"></script>
<script type="text/javascript">
  function set(v) {
  $("#tipe").val(v);
  }
  $(document).ready(function() {
    $("select").select2();
    $(".dt").datetimepicker({
      format:"YYYY-MM-DD HH:mm:ss"
    });
    @if(isset($data->id_ijin))
    console.log("Deactive");

    $("input").attr("disabled",true);
    $("textarea").attr("disabled",true);
    $("select").attr("disabled",true);
    @endif
  });
</script>
@stop
