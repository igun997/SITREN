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
              <label>Pengurus</label>
              <select class="form-control" name="id_pengurus">
                <option value="">== Pilih ==</option>
                @foreach(\Sitren\PengurusModel::all() as $k => $v)
                <option value="{{$v->id_pengurus}}">{{(isset($v->pegawai->nama_pegawai))?$v->pegawai->nama_pegawai:$v->santri->nama_lengkap}}</option>
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
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table" id="main">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Wali Kamar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach(\Sitren\AssignWalikamar::all() as $k => $v)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{(isset($v->pengurus->pegawai->nama_pegawai))?$v->pengurus->pegawai->nama_pegawai:$v->pengurus->santri->nama_lengkap}}</td>
                  <td>
                    <a href="{{url("admin/penerapan/walikamar/set/".$id."/unset/".$v->id_awr)}}" class="btn btn-danger">
                      <i class="fa fa-trash"></i>
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
  </div>
</div>
@stop

@section('css')

@stop

@section('js')
 <script type="text/javascript">
   $(document).ready(function() {
     $("select").select2();
     $("table").DataTable();
   });
 </script>
@stop
