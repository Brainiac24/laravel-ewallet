@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h3>Статус транзакции (за 3 дня)</h3>
    </div>
</div>    
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-fw fa-file-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Не подтверждённые</span>
          <span class="info-box-number">{{ $countNotVerified }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa  fa-close"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Отказаные</span>
          <span class="info-box-number">{{ $countRejected }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

   
  </div>










  
<div class="row">
    <div class="col-md-12">
        <h3>Статус синхронзиции (за 3 дня)</h3>
    </div>
</div>    
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-hourglass-1"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">В очереди</span>
          <span class="info-box-number">{{ $countOnQueue }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><i class="fa  fa-close"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ошибка обработки очереди</span>
          <span class="info-box-number">{{ $countErrorQueue }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-close"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ошибка обработки шины</span>
          <span class="info-box-number">{{ $countErrorBus }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
  </div>
  









  
<div class="row">
    <div class="col-md-12">
        <h3>Группа статусов (за 3 дня)</h3>
    </div>
</div>    
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><i class="fa fa-hourglass-1"></i></span>
  
          <div class="info-box-content">
            <span class="info-box-text">В очереди</span>
            <span class="info-box-number">{{ $countGroupInProcess }}</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    <!-- /.col -->
    
  </div>

@stop