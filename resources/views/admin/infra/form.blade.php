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
              <label>Nama Infrastruktur</label>
              <input type="text" class="form-control" value="{{@$data->nama_infra}}" name="nama_infra" >
            </div>
            <div class="form-group">
              <label>Kategori Infrastruktur</label>
              <select class="form-control" name="id_katinfra">
                <option>== Pilih Kategori ==</option>
                @foreach(\Sitren\KatinfraModel::all() as $k => $v)
                @if(isset($data->id_katinfra ))
                @if($data->id_katinfra == $v->id_katinfra)
                <option value="{{$v->id_katinfra}}" selected>{{$v->nama_katinfra}}</option>
                @else
                <option value="{{$v->id_katinfra}}">{{$v->nama_katinfra}}</option>
                @endif
                @endif
                @if(!isset($data->id_katinfra ))
                <option value="{{$v->id_katinfra}}">{{$v->nama_katinfra}}</option>
                @endif
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

@stop
