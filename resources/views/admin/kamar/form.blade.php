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
              <input type="text" class="form-control" value="{{@$data->nama_kamar}}" name="nama_kamar" >
            </div>
            <div class="form-group">
              <label>Asrama</label>
              <select class="form-control" name="asrama">
                <option>== Jenjang == </option>
                <option value="putera">Putra</option>
                <option value="putri">Putri</option>
                @if(isset($data->asrama))
                <option value="{{$data->asrama}}" selected>{{$data->asrama}}</option>
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
