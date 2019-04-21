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
        <div class="pull-right">
            <a href="{{url('admin/katinfra/tambah')}}" class="btn btn-success">
              <i class="fa fa-plus"></i>
            </a>
            <a href="{{url('admin/katinfra/import')}}" class="btn btn-warning">
              <i class="fa fa-upload"></i>
            </a>
        </div>
      </div>
      <div class="box-body">
        <table class="table" id="main">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Kategori</th>
              <th>Dibuat</th>
              <th>Diubah</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>

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
    $("#main").DataTable({
      ajax:"{{url('admin/katinfra')}}"
    });
  });
</script>
@stop
