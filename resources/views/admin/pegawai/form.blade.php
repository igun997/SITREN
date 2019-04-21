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
            <div class="form-group">
              <label>Nama Pegawai</label>
              <input type="text" required class="form-control" value="{{@$data->nama_pegawai}}" name="nama_pegawai" >
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select class="form-control" required name="jk">
                <option>== Jenis Kelamin == </option>
                <option value="laki-laki">Laki-Laki</option>
                <option value="perempuan">Perempuan</option>
                @if(isset($data->jk))
                <option value="{{$data->jk}}" selected>{{$data->jk}}</option>
                @endif
              </select>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" value="{{@$data->email}}" name="email" >
            </div>
            <div class="form-group">
              <label>No Telepon</label>
              <input type="text" class="form-control" value="{{@$data->notelp}}" name="notelp" >
            </div>
            <div class="form-group">
              <label>Alamat</label>
              <textarea class="form-control" required  name="alamat" >{{@$data->alamat}}</textarea>
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

@stop
