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
        <table class="table" id="main">
          <thead>
            <tr>
              <th>No</th>
              <th>No Rekening</th>
              <th>Nama Nasabah</th>
              <th>Kelas</th>
              <th>Kamar</th>
              <th>Jumlah Sisa Tabungan</th>
              <th>Dibuat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $k => $v)
            <tr>
              <td>{{$k+1}}</td>
              <td>{{$v->santri->id_santri}}</td>
              <td>{{$v->santri->nama_lengkap}}</td>
              <td>{{\Sitren\AssignKelas::where(["id_santri"=>$v->id_santri])->first()->kelas->nama_kelas}}</td>
              <td>{{\Sitren\AssignKamar::where(["id_santri"=>$v->id_santri])->first()->kamar->nama_kamar}}</td>
              <td>Rp.{{number_format((\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"masuk"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"keluar"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_admin"])->sum("jumlah"))-(\Sitren\TransaksiModel::where(["id_santri"=>$v->id_santri,"jenis"=>"biaya_transfer"])->sum("jumlah")))}}</td>
              <td>{{date("d-m-Y H:i:s",strtotime($v->created_at))}}</td>
              <td>
                <a href="{{url("bmt/nasabah/view/".$v->id_santri)}}" class="btn btn-success"><i class="fa fa-search"></i></a>
                <button type="button"  class="btn btn-primary trx" data-id="{{$v->santri->id_santri}}">
                  <i class="fa fa-money"></i>
                </button>
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
<script src="{{url('js/bootbox.min.js')}}" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#main").DataTable({

    });
    $("#main").on('click', '.trx', function(event) {
      event.preventDefault();
      id = $(this).data("id");
      console.log("Rekening "+id);
      var dialog = bootbox.dialog({
        title: 'Transaksi Nasabah',
        message: '<p><center><i class="fa fa-spin fa-spinner"></i> Loading...</center></p>'
      });
      dialog.init(function() {
        setTimeout(function() {
          $.get("{{route("api.bmt.getInfoSantri")}}/"+id,function(r){
            if (r.status == 200) {
              dialog.find(".bootbox-title").html("Data Tabungan ["+r.data.data_diri.id_santri+"]");
              var trx = [
                "<div class=row style='margin-top:20px'>",
                "<div class=col-md-12>",
                "<form id=dform action='' method=post onsubmit='return false'>",
                "<div class=col-md-12>",
                "<p>0 = Untuk Transaksi Masuk</p>",
                "<p>1 = Untuk Transaksi Keluar</p>",
                "</div>",
                "<div class=col-md-4>",
                "<div class=form-group>",
                "<label>Jenis Trx</label>",
                "<input class=form-control min=0 max=1 type=number id=jenistrx name=jenis required/>",
                "</div>",
                "</div>",
                "<div class=col-md-4>",
                "<div class=form-group>",
                "<label>Jumlah</label>",
                "<input class=form-control max='"+r.data.data_bmt.total_tabungan_unformat+"' id=jumlahtrx min=0 type=number name=jumlah required/>",
                "</div>",
                "</div>",

                "<div class=col-md-4>",
                "<div class=form-group>",
                "<label>Keterangan</label>",
                "<input class=form-control type=text name=keterangan placeholder='Bisa Di Kosongkan'/>",
                "</div>",
                "</div>",
                "<div class=col-md-12>",
                "<div class=form-group>",
                "<button class='btn btn-success btn-block' type='submit'>Simpan Transaksi</button>",
                "</div>",
                "</div>",
                '{{csrf_field()}}',
                "</form>",
                "</div>",
                "<div class=col-md-12 style='margin-top:20px'>",
                "<div class=table-responsive>",
                "<table class=table id=dtable>",
                "<thead>",
                "<th>No</th>",
                "<th>Jenis</th>",
                "<th>Jumlah</th>",
                "<th>Ket</th>",
                "<th>Operator</th>",
                "<th>Tgl. Trx</th>",
                "</thead>",
                "<tbody>",
                "</tbody>",
                "</table>",
                "</div>",
                "</div>",
                "</div>",
              ]
              var body = [
                "<div class=row>",
                "<div class=col-md-6>",
                "<div class=form-group>",
                "<label>No Rekening</label>",
                "<input class=form-control value='"+r.data.data_diri.id_santri+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Nama Lengkap</label>",
                "<input class=form-control value='"+r.data.data_diri.nama_lengkap+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Kelas / Kamar</label>",
                "<input class=form-control value='"+r.data.data_diri.kelas_kamar+"' disabled/>",
                "</div>",
                "</div>",
                "<div class=col-md-6>",
                "<div class=form-group>",
                "<label>Total Tabungan</label>",
                "<input class=form-control id=totaltabungan value='"+r.data.data_bmt.total_tabungan+"' disabled/>",
                "</div>",
                "</div>",
                "</div>",
                trx.join(""),
              ];
              dialog.find(".bootbox-body").html(body.join(""));
              cis =  dialog.find("#dtable").DataTable({
                ajax:"{{route("api.bmt.getTabunganBySantri")}}/"+r.data.data_diri.id_santri,
                order:[[0,"asc"]],
                pageLength: 5,
                lengthChange: false
              })
              dialog.find("#jenistrx").focus();
              function reloadIt(){
                $.get("{{route("api.bmt.getInfoSantri")}}/"+id,function(r){
                  dialog.find("#totaltabungan").val(r.data.data_bmt.total_tabungan);
                });
              }
              dialog.find("#dform").on('submit', function(event) {
                event.preventDefault();
                dform = $(this).serializeArray();
                console.log(dform);
                $.post("{{route("api.bmt.savetrx")}}/"+r.data.data_diri.id_santri,dform,function(r){
                  if (r.status == 200) {
                    alert(r.msg);
                  }else {
                    alert(r.msg);
                  }
                  cis.ajax.reload();
                  reloadIt();
                  $("#dform").trigger("reset");
                }).fail(function(){
                  alert("Anda Terputus Dengan Server");
                })
              });
              dialog.find("#jenistrx").on('change', function(event) {
                event.preventDefault();
                if (parseFloat($(this).val()) == 1) {
                  $("#jumlahtrx").attr("max",parseFloat(r.data.data_bmt.total_tabungan_unformat));
                }else {
                  $("#jumlahtrx").attr("max",9999999999999999999999);
                }
              });
            }else {
              bootbox.hideAll();
              alert("Data Santri Tidak Ditemukan");
            }
          }).fail(function(){
            alert("Gagal Terkoneksi Ke Server");
          });
        },500);
      });
    });
  });
</script>
@stop
