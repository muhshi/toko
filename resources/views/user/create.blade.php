@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Create Data user </h2>
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
          @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2)
          {{ Form::open(array('action' => 'UserController@store', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                      <span class="section">Data user</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nama" placeholder="misal: warkito" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username" class="form-control col-md-7 col-xs-12" name="username" placeholder="misal: warkito" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="misal: warkito@email.com" required="required" type="email">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">Ho HP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="no_hp" class="form-control col-md-7 col-xs-12" name="no_hp" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="toko_id">ID Toko <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="toko_id" class="form-control col-md-7 col-xs-12" name="toko_id" required="required" type="number">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Level</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="level_id">
                            <option value="-1" disabled>Pilih ID</option>
                            @if(Auth::user()->level_id == 1)
                            <option value="1">Admin</option>
                            <option value="2">Owner</option>
                            <option value="3">Investor</option>
                            <option value="4">Operator</option>
                            <option value="5">Freelancer</option>
                            @elseif(Auth::user()->level_id == 2)
                            <option value="3">Investor</option>
                            <option value="4">Operator</option>
                            <option value="5">Freelancer</option>
                            @elseif(Auth::user()->level_id == 3)
                            <option value="4">Operator</option>
                            <option value="5">Freelancer</option>
                            @endif
                          </select>
                        </div>
                      </div>


                      <div class="item form-group hidden">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input  id="creator_id" class="form-control col-md-7 col-xs-12" name="creator_id" value="{{ Auth::user()->id }}" type="number">
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