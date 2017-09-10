@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Create Data Lisensi </h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        @if(count($errors)>0)
          <div class="well">
            <ul style="color: red;">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach 
            </ul>
          </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12" style="color: white;">
              <a>.</a>
            </div>
            <div class="col-md-6">
              <div class="alert alert-success alert-block" style="width: 100%">
                <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
              </div>
            </div>
        </div>
        @endif
          <br />
          @if(Auth::user()->level_id == 1)
          {{ Form::open(array('action' => 'LisensiController@store', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                      <span class="section">Data Lisensi</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">ID User <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="user_id" class="form-control col-md-7 col-xs-12" name="user_id" type="text" >
                        </div>
                      </div>

                      <div class="item form-group hidden">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="tanggal" class="form-control col-md-7 col-xs-12" name="tanggal" type="text" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="jumlah" class="form-control col-md-7 col-xs-12" name="jumlah" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Keterangan </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="keterangan">
                            <option value="-1" disabled>Pilih Keterangan</option>
                            <option value="1">Top Up</option>
                            <option value="2">Penggunaan</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="toko_id">ID Toko </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="toko_id" class="form-control col-md-7 col-xs-12" name="toko_id" type="number">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

          <?php echo Form::close() ?>
          @else
              <div>
                <h2> Anda Tidak Berwenang Memasuki Halaman Ini </h2>
              </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@stop