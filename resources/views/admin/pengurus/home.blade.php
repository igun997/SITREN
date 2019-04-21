@extends('adminlte::page')

@section('title', $title)

@section('content')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-title">
          {{$title}}
        </div>
        <div class="pull-right">
            <a href="{{url('admin/pengurus/tambah')}}" class="btn btn-success">
              <i class="fa fa-plus"></i>
            </a>
        </div>
      </div>
      <div class="box-body">
        <div class="col-md-6">
          <div class="table-responsive">
            <table class="table" id="santri">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Level</th>
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
        <div class="col-md-6">
          <div class="table-responsive">
          <table class="table" id="pegawai">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Lengkap</th>
              <th>Username</th>
              <th>Email</th>
              <th>Level</th>
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
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $("#santri").DataTable({
      ajax:"{{url('admin/pengurus?type=santri')}}"
    });
    $("#pegawai").DataTable({
      ajax:"{{url('admin/pengurus?type=pegawai')}}"
    });
  });
</script>
@stop
