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
              <label>Santri</label>
              <select class="form-control" name="id_santri">
                <option value="">== Pilih ==</option>
                @foreach(\Sitren\SantriModel::all() as $k => $v)
                <option value="{{$v->id_santri}}">{{$v->nama_lengkap}}</option>
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
                  <th>NIS</th>
                  <th>Nama Lengkap</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach(\Sitren\AssignKelas::all() as $k => $v)
                <tr>
                  <td>{{$v->santri->id_santri}}</td>
                  <td>{{$v->santri->nama_lengkap}}</td>
                  <td>
                    <a href="{{url("admin/penerapan/kelas/set/".$id."/unset/".$v->id_aks)}}" class="btn btn-danger">
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
