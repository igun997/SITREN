@extends('adminlte::page')

@section('title', $title)

@section('content_header')

@stop

@section('content')
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-title">
          Data Perijinan Santri
        </div>
        <div class="pull-right">
          <a href="{{url("pengurus/ijin/tambah")}}" class="btn btn-success">
            <i class="fa fa-plus"></i>
          </a>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table" id="main">
            <thead>
              <th>No</th>
              <th>Nama Santri</th>
              <th>Penerima Ijin</th>
              <th>Tujuan Ijin</th>
              <th>Waktu Ijin</th>
              <th>Tanggal Keluar</th>
              <th>Tanggal Masuk</th>
              <th>Status Ijin</th>
              <th>Dibuat</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              
            </tbody>
          </table>
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
  $("#main").DataTable({
    ajax:"{{url("pengurus/ijin")}}"
  })
</script>
@stop
