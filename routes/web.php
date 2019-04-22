<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::group(['middleware' => ['web']], function () {
  Route::get('/', function () {
    return view('welcome');
  });
  Route::get('/test', function () {
    return view("letter.struk");
  });
  Route::get('/logout', function () {
    session()->flush();
    return redirect("/login");
  });
});
Route::group(['middleware' => ['admin']], function () {
  Route::get('/admin','Admin\AdminControl@index');
  //Kelas
  Route::get('/admin/kelas','Admin\KelasControl@index');
  Route::get('/admin/kelas/tambah','Admin\KelasControl@tambah');
  Route::post('/admin/kelas/tambah','Admin\KelasControl@tambah_aksi');
  Route::get('/admin/kelas/edit/{id}','Admin\KelasControl@edit');
  Route::post('/admin/kelas/edit/{id}','Admin\KelasControl@edit_aksi');
  Route::get('/admin/kelas/hapus/{id}','Admin\KelasControl@hapus');
  Route::get('/admin/kelas/import','Admin\KelasControl@import');
  Route::post('/admin/kelas/import','Admin\KelasControl@import_aksi');
  //Kamar
  Route::get('/admin/kamar','Admin\KamarControl@index');
  Route::get('/admin/kamar/tambah','Admin\KamarControl@tambah');
  Route::post('/admin/kamar/tambah','Admin\KamarControl@tambah_aksi');
  Route::get('/admin/kamar/edit/{id}','Admin\KamarControl@edit');
  Route::post('/admin/kamar/edit/{id}','Admin\KamarControl@edit_aksi');
  Route::get('/admin/kamar/hapus/{id}','Admin\KamarControl@hapus');
  Route::get('/admin/kamar/import','Admin\KamarControl@import');
  Route::post('/admin/kamar/import','Admin\KamarControl@import_aksi');
  //Santri
  Route::get('/admin/santri','Admin\SantriControl@index');
  Route::get('/admin/santri/tambah','Admin\SantriControl@tambah');
  Route::post('/admin/santri/tambah','Admin\SantriControl@tambah_aksi');
  Route::get('/admin/santri/edit/{id}','Admin\SantriControl@edit');
  Route::post('/admin/santri/edit/{id}','Admin\SantriControl@edit_aksi');
  Route::get('/admin/santri/hapus/{id}','Admin\SantriControl@hapus');
  Route::get('/admin/santri/import','Admin\SantriControl@import');
  Route::post('/admin/santri/import','Admin\SantriControl@import_aksi');
  //Pegawai
  Route::get('/admin/pegawai','Admin\PegawaiControl@index');
  Route::get('/admin/pegawai/tambah','Admin\PegawaiControl@tambah');
  Route::post('/admin/pegawai/tambah','Admin\PegawaiControl@tambah_aksi');
  Route::get('/admin/pegawai/edit/{id}','Admin\PegawaiControl@edit');
  Route::post('/admin/pegawai/edit/{id}','Admin\PegawaiControl@edit_aksi');
  Route::get('/admin/pegawai/hapus/{id}','Admin\PegawaiControl@hapus');
  Route::get('/admin/pegawai/import','Admin\PegawaiControl@import');
  Route::post('/admin/pegawai/import','Admin\PegawaiControl@import_aksi');
  //Katinfra
  Route::get('/admin/katinfra','Admin\KatinfraControl@index');
  Route::get('/admin/katinfra/tambah','Admin\KatinfraControl@tambah');
  Route::post('/admin/katinfra/tambah','Admin\KatinfraControl@tambah_aksi');
  Route::get('/admin/katinfra/edit/{id}','Admin\KatinfraControl@edit');
  Route::post('/admin/katinfra/edit/{id}','Admin\KatinfraControl@edit_aksi');
  Route::get('/admin/katinfra/hapus/{id}','Admin\KatinfraControl@hapus');
  Route::get('/admin/katinfra/import','Admin\KatinfraControl@import');
  Route::post('/admin/katinfra/import','Admin\KatinfraControl@import_aksi');
  //Infra
  Route::get('/admin/infra','Admin\InfraControl@index');
  Route::get('/admin/infra/tambah','Admin\InfraControl@tambah');
  Route::post('/admin/infra/tambah','Admin\InfraControl@tambah_aksi');
  Route::get('/admin/infra/edit/{id}','Admin\InfraControl@edit');
  Route::post('/admin/infra/edit/{id}','Admin\InfraControl@edit_aksi');
  Route::get('/admin/infra/hapus/{id}','Admin\InfraControl@hapus');
  Route::get('/admin/infra/import','Admin\InfraControl@import');
  Route::post('/admin/infra/import','Admin\InfraControl@import_aksi');
  //Pengurus
  Route::get('/admin/pengurus','Admin\PengurusControl@index');
  Route::get('/admin/pengurus/tambah','Admin\PengurusControl@tambah');
  Route::post('/admin/pengurus/tambah','Admin\PengurusControl@tambah_aksi');
  Route::get('/admin/pengurus/edit/{id}','Admin\PengurusControl@edit');
  Route::post('/admin/pengurus/edit/{id}','Admin\PengurusControl@edit_aksi');
  Route::get('/admin/pengurus/hapus/{id}','Admin\PengurusControl@hapus');
  Route::get('/admin/pengurus/import','Admin\PengurusControl@import');
  Route::post('/admin/pengurus/import','Admin\PengurusControl@import_aksi');
  //Asign
  Route::get('/admin/penerapan/kelas','Admin\PenerapanControl@kelas');
  Route::get('/admin/penerapan/kelas/set/{id}','Admin\PenerapanControl@setkelas');
  Route::post('/admin/penerapan/kelas/set/{id}','Admin\PenerapanControl@setkelas_aksi');
  Route::get('/admin/penerapan/kelas/set/{id}/unset/{del}','Admin\PenerapanControl@unsetkelas_aksi');

  Route::get('/admin/penerapan/kamar','Admin\PenerapanControl@kamar');
  Route::get('/admin/penerapan/kamar/set/{id}','Admin\PenerapanControl@setkamar');
  Route::post('/admin/penerapan/kamar/set/{id}','Admin\PenerapanControl@setkamar_aksi');
  Route::get('/admin/penerapan/kamar/set/{id}/unset/{del}','Admin\PenerapanControl@unsetkamar_aksi');

  Route::get('/admin/penerapan/walikamar','Admin\PenerapanControl@walikamar');
  Route::get('/admin/penerapan/walikamar','Admin\PenerapanControl@walikamar');
  Route::get('/admin/penerapan/walikamar/set/{id}','Admin\PenerapanControl@setwalikamar');
  Route::post('/admin/penerapan/walikamar/set/{id}','Admin\PenerapanControl@setwalikamar_aksi');
  Route::get('/admin/penerapan/walikamar/set/{id}/unset/{del}','Admin\PenerapanControl@unsetwalikamar_aksi');
});
Route::group(['middleware' => ['pengurus']], function () {
  Route::get('/pengurus','Pengurus\PengurusControl@index');

  Route::get('/pengurus/santri','Pengurus\IjinControl@index');
  Route::get('/pengurus/santri/view/{id}','Pengurus\IjinControl@view');
  Route::get('/pengurus/santri/cetak/{id}','Pengurus\IjinControl@cetak');
  Route::post('/pengurus/santri/cetak/{id}','Pengurus\IjinControl@cetak_aksi');
  Route::get('/pengurus/santri/daftar/{id}','Pengurus\IjinControl@daftar');
  Route::post('/pengurus/santri/daftar/{id}','Pengurus\IjinControl@daftar_aksi');

  Route::get('/pengurus/ijin','Pengurus\IjinControl@index');
  Route::post('/pengurus/ijin','Pengurus\IjinControl@ijin_aksi');
  Route::get('/pengurus/ijin/cetak/{id}','Pengurus\IjinControl@cetak');
  Route::get('/pengurus/ijin/tambah','Pengurus\IjinControl@tambah');
  Route::post('/pengurus/ijin/tambah','Pengurus\IjinControl@tambah_aksi');
  Route::get('/pengurus/ijin/daftar/{id}','Pengurus\IjinControl@daftar');
  Route::get('/pengurus/ijin/daftar/{id}/{tipe}','Pengurus\IjinControl@daftar_aksi');
});

Route::group(['middleware' => ['bmt']], function () {
  Route::get('/bmt','Bmt\BmtControl@index');
  Route::get('/bmt/trigger','Bmt\BmtControl@trigger');
  Route::get('/bmt/nasabah','Bmt\NasabahControl@index');
  Route::get('/bmt/nasabah/view/{id}','Bmt\NasabahControl@view');
  Route::get('/bmt/nasabah/print/{id}','Bmt\NasabahControl@print');

  Route::get('/bmt/transaksi','Bmt\TransaksiControl@index');
  Route::get('/bmt/transaksi/setor/{id?}','Bmt\TransaksiControl@setor');
  Route::post('/bmt/transaksi/setor/{id?}','Bmt\TransaksiControl@setor_aksi');
  Route::get('/bmt/transaksi/tarik','Bmt\TransaksiControl@tarik');
  Route::get('/bmt/transaksi/tarik/{id?}','Bmt\TransaksiControl@tarik');
  Route::post('/bmt/transaksi/tarik/{id?}','Bmt\TransaksiControl@tarik_aksi');
  Route::get('/bmt/transaksi/cetak/{id}','Bmt\TransaksiControl@cetak');

  Route::get('/bmt/laporan','Bmt\LaporanControl@index');
  Route::post('/bmt/laporan','Bmt\LaporanControl@index_aksi');
  Route::get('/bmt/pengaturan','Bmt\PengaturanControl@index');
  Route::post('/bmt/pengaturan','Bmt\PengaturanControl@index_aksi');
});
Route::group(['middleware' => ['tu']], function () {
  Route::get('/tu','TuControl@index');
});
Route::group(['middleware' => ['santri']], function () {
  Route::get('/santri','SantriControl@index');
});
