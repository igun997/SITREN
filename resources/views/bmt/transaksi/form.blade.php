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
          <form class="form-horizontal" action="" >
            <div class="form-group">
              <label>Nama Nasabah</label>
              <select class="form-control" name="id_katinfra">
                <option selected>== Pilih Nasabah ==</option>
                @foreach(\Sitren\SantriModel::all() as $k => $v)
                <option value="{{$v->id_santri}}">{{$v->id_santri}} - {{$v->nama_lengkap}}</option>
                @endforeach
              </select>
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
<script type="text/javascript">
  $(document).ready(function() {
    $("select").select2();
    $("select").on('change', function(event) {
      event.preventDefault();
      if (this.value != null | this.value != "") {
          location.href = "{{url("bmt/transaksi/".$jenis)}}/"+this.value;
      }
    });
  });
</script>
@stop
