@extends('adminlte::page')

@section('title', $title)

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
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

          <form class="form-horizontal" action="" method="post">
            @csrf
            <div class="col-md-5">
              <div class="form-group">
                <label>Nomor Induk Santri</label>
                <input type="text" class="form-control" disabled value="{{$data->id_santri}}">
              </div>
              <div class="form-group">
                <label>Nama Nasabah</label>
                <input type="text" class="form-control" disabled value="{{$data->nama_lengkap}}">
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea disabled class="form-control" rows="3" cols="80">{{$data->alamat_lengkap_ayah}}</textarea>
              </div>
              <div class="form-group">
                <label>Total Simpanan</label>
                <input type="text" class="form-control" disabled value="Rp. {{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$data->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}">
              </div>
              <div class="form-group">
                <label>[Kelas] - [Kamar]</label>
                <input type="text" class="form-control" disabled value="[{{(\Sitren\AssignKelas::where(["id_santri"=>$data->id_santri])->first()->kelas->nama_kelas)}}] - [{{(\Sitren\AssignKamar::where(["id_santri"=>$data->id_santri])->first()->kamar->nama_kamar)}}]">
              </div>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-5">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="text" required class="form-control mask" name="jumlah" value="">
              </div>
              <input type="text" hidden name="jenis" value="keluar">
              <input type="text" name="id_santri" hidden value="{{$data->id_santri}}">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" cols="80"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">
                  Simpan Transaksi
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="{{url("js/jquery.mask.min.js")}}" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.mask').mask('000.000.000.000.000', {reverse: true});
    $("form").submit(function() {
        $(".mask").unmask();
    });
  });
</script>
@stop
