@extends('adminlte::page')

@section('title', $title)

@section('content_header')

@stop

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
        <table class="table" id="main">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kamar</th>
              <th>Dibuat</th>
              <th>Diubah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach(\Sitren\KamarModel::all() as $k => $v)
            <tr>
              <td>{{$no++}}</td>
              <td>{{$v->nama_kamar}}</td>
              <td>{{date("d-m-Y",strtotime($v->created_at))}}</td>
              <td>{{date("d-m-Y",strtotime($v->updated_at))}}</td>
              <td>
                <a href="{{url("admin/penerapan/kamar/set/".$v->id_kamar)}}" class="btn btn-primary">
                  <i class="fa fa-plus"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
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
    $("#main").DataTable();
  });
</script>

@stop
