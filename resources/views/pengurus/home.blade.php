@extends('adminlte::page')

@section('title', $title)

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="row">

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Santri</span>
          <span class="info-box-number">{{\Sitren\SantriModel::all()->count()}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Pengurus</span>
          <span class="info-box-number">{{\Sitren\PengurusModel::all()->count()}}</span>
        </div>
      </div>
    </div>
  </div>
@stop

@section('css')

@stop

@section('js')

@stop
