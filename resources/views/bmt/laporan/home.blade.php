@extends('adminlte::page')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
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
            <div class="form-group">
              <label>Jenis Laporan</label>
              <select class="form-control" name="jenis">
                <option>== Pilih ==</option>
                <option value="per_nasabah">Laporan Per Nasabah</option>
                <option value="pendapatan">Laporan Pendapatan</option>
                <option value="per_aktivitas">Laporan Aktivitas</option>
              </select>
            </div>
            <div class="form-group">
              <label>Dari</label>
              <input type="text" class="form-control" name="start" value="">
            </div>
            <div class="form-group">
              <label>Sampai</label>
              <input type="text" class="form-control" name="end" value="">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">
                Buat Laporan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("input").datepicker({
      format:"yyyy-mm-dd"
    })
  });
</script>
@stop
