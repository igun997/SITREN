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
            <div class="col-md-12">
              <div class="form-group">
                <h3>Data Personal</h3>
              </div>
              @if(!isset($data->nama_lengkap))
              <div class="form-group">
                <label>ID Santri</label>
                <input type="text" readonly class="form-control" required value="{{genid("putra")}}" name="id_santri">
              </div>
              @endif
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" required value="{{@$data->nama_lengkap}}" name="nama_lengkap" placeholder="">
              </div>
              <div class="form-group">
                <label>Nama Panggilan</label>
                <input type="text" class="form-control" value="{{@$data->nama_panggilan}}" name="nama_panggilan" placeholder="">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" required name="jenis_kelamin" >
                  @if(isset($data->jenis_kelamin))
                  <option value="{{$data->jenis_kelamin}}">{{strtoupper($data->jenis_kelamin)}}</option>
                  @endif
                  <option value="laki-laki">Laki-Laki</option>
                  <option value="perempuan">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Tempat,Tanggal Lahir</label>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="tmpt_lhir" value="{{@$data->tmpt_lhir}}" required placeholder="Tempat Lahir">
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control tgl" name="tgl_lhr" required value="{{@date("Y-m-d",strtotime($data->tgl_lhr))}}" placeholder="Tanggal Lahir">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Anak Ke, Dari</label>
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="anak_ke" value="{{@$data->anak_ke}}" placeholder="Anak Ke">
                  </div>
                  <div class="col-md-6 col-xs-12">
                    <input type="text" class="form-control" name="total_anak" value="{{@$data->total_anak}}" placeholder="Total Anak">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label>Status Keluarga</label>
                <select class="form-control" name="status_keluarga" >
                  @if(isset($data->status_keluarga))
                  <option value="{{@$data->status_keluarga}}">{{@$data->status_keluarga}}</option>
                  @endif
                  <option value="lengkap">Lengkap</option>
                  <option value="yatim">Yatim</option>
                  <option value="piatu">Piatu</option>
                  <option value="yatim piatu">Yatim Piatu</option>
                  <option value="angkat">Angkat</option>
                </select>
              </div>
              <div class="form-group">
                <label>Bahasa Sehari Hari</label>
                <input type="text" class="form-control" required name="bahasa_harian" value="{{@$data->bahasa_harian}}" placeholder="">
              </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <h3>Data Ayah</h3>
                </div>
                <div class="form-group">
                  <label>Nama Ayah</label>
                  <input type="text" class="form-control" name="nama_ayah" value="{{@$data->nama_ayah}}" placeholder="">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tempat,Tanggal Lahir</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control" name="tmpt_lhir_ayah" value="{{@$data->tmpt_lhir_ayah}}"  placeholder="Tempat Lahir">
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control tgl" name="tgl_lhir_ayah" value="{{@date("Y-m-d",strtotime($data->tgl_lhr_ayah))}}"  placeholder="Tanggal Lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat Lengkap</label>
                  <textarea name="alamat_lengkap_ayah" class="form-control" rows="8" cols="80">{{@$data->alamat_lengkap_ayah}}</textarea>
                </div>
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control kec" name="kec_ayah" value="{{@$data->kec_ayah}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Kota/Kab</label>
                  <input type="text" class="form-control kota" name="kota_ayah" value="{{@$data->kota_ayah}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Privinsi</label>
                  <input type="text" class="form-control prop" name="prop_ayah" value="{{@$data->prop_ibu}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>No Telepon</label>
                  <input type="text" class="form-control" name="notelp_ayah" value="{{@$data->notelp_ayah}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Pendidikan Terakhir</label>
                  <select class="form-control" name="pendidikan_ayah">
                    <option  value="{{@$data->pendidikan_ayah}}" selected>{{@$data->pendidikan_ayah}}</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Penghasilan</label>
                  <select class="form-control" name="penghasilan_ayah">
                    @if(isset($data->penghasilan_ayah))
                    <option value="{{@$data->penghasilan_ayah}}" selected>{{@$data->penghasilan_ayah_string}}</option>
                    @else
                    <option value="" selected></option>
                    @endif
                    <option value="<1">< 1.000.000</option>
                    <option value="1-2.5">1.000.000 - 2.500.000</option>
                    <option value="2.5-5">2.500.000 - 5.000.000</option>
                    <option value="5-10">5.000.000 - 10.000.000</option>
                    <option value="10>">10.000.000 ></option>
                  </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <h3>Data Ibu</h3>
                </div>
                <div class="form-group">
                  <label>Nama Ibu</label>
                  <input type="text" class="form-control" value="{{@$data->nama_ibu}}" name="nama_ibu" placeholder="">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tempat,Tanggal Lahir</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control" value="{{@$data->tmpt_lhir_ibu}}" name="tmpt_lhir_ibu"  placeholder="Tempat Lahir">
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control tgl" value="{{@$data->tmpt_lhir_ayah}}" name="tgl_lhir_ibu"  placeholder="Tanggal Lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat Lengkap</label>
                  <textarea name="alamat_lengkap_ibu" class="form-control" rows="8" cols="80">{{@$data->alamat_lengkap_ibu}}</textarea>
                </div>
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input type="text" class="form-control kec" name="kec_ibu" value="{{@$data->kec_ibu}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Kota/Kab</label>
                  <input type="text" class="form-control kota" name="kota_ibu" value="{{@$data->kota_ibu}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Privinsi</label>
                  <input type="text" class="form-control prop" name="prop_ibu" value="{{@$data->prop_ibu}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>No Telepon</label>
                  <input type="text" class="form-control" name="notelp_ibu" value="{{@$data->notelp_ibu}}" placeholder="">
                </div>
                <div class="form-group">
                  <label>Pendidikan Terakhir</label>
                  <select class="form-control" name="pendidikan_ibu">
                    <option value="{{@$data->pendidikan_ibu}}" selected>{{@$data->pendidikan_ibu}}</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                    <option value="S3">S3</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Penghasilan</label>
                  <select class="form-control" name="penghasilan_ibu">
                    @if(isset($data->penghasilan_ibu))
                    <option value="{{@$data->penghasilan_ibu}}" selected>{{@$data->penghasilan_ibu_string}}</option>
                    @else
                    <option value="" selected></option>
                    @endif
                    <option value="<1">< 1.000.000</option>
                    <option value="1-2.5">1.000.000 - 2.500.000</option>
                    <option value="2.5-5">2.500.000 - 5.000.000</option>
                    <option value="5-10">5.000.000 - 10.000.000</option>
                    <option value="10>">10.000.000 ></option>
                  </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                  <h3>Data Wali</h3>
                </div>
                <div class="form-group">
                  <label>Nama Wali</label>
                  <input type="text" class="form-control" name="nama_wali" placeholder="">
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <label>Tempat,Tanggal Lahir</label>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control" name="tmpt_lhir_wali" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <input type="text" class="form-control tgl" name="tgl_lhir_wali" placeholder="Tanggal Lahir">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat Lengkap</label>
                  <textarea name="alamat_lengkap_wali" class="form-control" rows="8" cols="80"></textarea>
                </div>
           </div>
           @if($req->input("type") != "view")
            <div class="col-md-12">
              <div class="form-group">
                <button type="reset" class="btn btn-danger">
                  Reset
                </button>
                <button type="submit" class="btn btn-success">
                  Simpan
                </button>
              </div>
            </div>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
@stop

@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    @if($req->input("type") == "view")
    $("input").attr('disabled', true);
    $("select").attr('disabled', true);
    $("textarea").attr('disabled', true);
    @endif
    $(".tgl").datepicker({
      format:"yyyy-mm-dd"
    });
  });
</script>
@stop
