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
              <label>Nama Kelas</label>
              <input type="text" class="form-control" value="{{@$data->nama_kelas}}" name="nama_kelas" >
            </div>
            <div class="form-group">
              <label>Jenjang</label>
              <select class="form-control" name="jenis">
                <option>== Jenjang == </option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA">SMA</option>
                <option value="PT">PT</option>
                @if(isset($data->jenis))
                <option value="{{$data->jenis}}" selected>{{$data->jenis}}</option>
                @endif
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

@stop
