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
          <form class="form-horizontal" action="" method="post">
            @csrf
            @if(isset($data->user->id))
            <input type="text" hidden name="id" value="{{$data->user->id}}">
            @endif
            <div class="form-group">
              <label>Username</label>
              <input type="text" required class="form-control" value="{{@$data->user->name}}" name="name">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" required class="form-control" value="{{@$data->user->email}}" name="email">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="text" {{(!isset($data->id_pengurus))?"required":""}} class="form-control" name="password">
            </div>
            <div class="form-group">
              <label>Level</label>
              <select class="form-control" required name="level">
                <option value="">== Pilih Level == </option>
                @if(isset($data->user->level))
                <option value="{{$data->user->level}}" selected>{{strtoupper($data->user->level)}}</option>
                @endif
                <option value="admin">ADMIN</option>
                <option value="bmt">BMT</option>
                <option value="tu">TU</option>
                <option value="pengurus">PENGURUS</option>
              </select>
            </div>
            <div class="form-group">
              <label>Data Santri</label>
              <select class="form-control select2" name="id_santri">
                @foreach(\Sitren\SantriModel::all() as $k => $v)
                @if(isset($data->santri->id_santri))
                @if($v->id_santri == $data->santri->id_santri)
                <option value="{{$v->id_santri}}" selected>{{$v->nama_lengkap}}</option>
                <option value="" >== Pilih ==</option>
                @endif
                @endif
                @if(!isset($data->santri->id_santri))
                <option value="" selected>== Pilih ==</option>
                @endif

                <option value="{{$v->id_santri}}">{{$v->nama_lengkap}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Data Pegawai</label>
              <select class="form-control select2" name="id_pegawai">
                @foreach(\Sitren\PegawaiModel::all() as $k => $v)
                @if(isset($data->pegawai->id_pegawai))
                @if($v->id_pegawai == $data->pegawai->id_pegawai)
                <option value="{{$v->id_pegawai}}" selected>{{$v->nama_pegawai}}</option>
                <option value="">== Pilih ==</option>
                @endif
                @endif
                @if(!isset($data->pegawai->id_pegawai))
                <option value="" selected>== Pilih ==</option>
                @endif
                <option value="{{$v->id_pegawai}}">{{$v->nama_pegawai}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <button type="reset" class="btn btn-danger">
                Reset
              </button>
              <button type="submit" class="btn btn-success">
                Simpan
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

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $(".select2").select2({

    });
  });
</script>
@stop
