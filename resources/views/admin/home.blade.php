@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Kelas</span>
          <span class="info-box-number">{{\Sitren\KelasModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-home"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Kamar</span>
          <span class="info-box-number">{{\Sitren\KamarModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Santri</span>
          <span class="info-box-number">{{\Sitren\SantriModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pegawai</span>
          <span class="info-box-number">{{\Sitren\PegawaiModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-gear"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Infrastruktur</span>
          <span class="info-box-number">{{\Sitren\InfraModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pengurus</span>
          <span class="info-box-number">{{\Sitren\PengurusModel::all()->count()}}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box">
        <div class="box-header">
          <div class="box-title">
            Data Aktivitas Pengguna
          </div>
        </div>
        <div class="box-body">

        </div>
      </div>
    </div>
  </div>
@stop

@section('css')

@stop

@section('js')

@stop
