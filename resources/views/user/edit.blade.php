@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Input Data User</h2>
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
                    <br />
                    {{ Form::open(array('action' => 'UserController@update', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                    <span class="section">Data User</span>

                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="name" placeholder="misal: Warkito" required="required" type="text" value="{{ $user->name }}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username" class="form-control col-md-7 col-xs-12" name="username" placeholder="misal: warkito" required="required" type="text" value="{{ $user->username }}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="misal: warkito@email.com" required="required" type="email" value="{{ $user->email }}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">Ho HP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="no_hp" class="form-control col-md-7 col-xs-12" name="no_hp" required="required" type="text" value="{{ $user->no_hp }}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="toko_id">ID Toko <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="toko_id" class="form-control col-md-7 col-xs-12" name="toko_id" required="required" type="number" value="{{ $user->toko_id }}">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Level</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="level_id">
                            <option value="-1" disabled>Pilih ID</option>
                            <?php
                                $temp = ["Admin", "Owner", "Sedang", "Investor", "Operator", "Freelancer"];
                                for($i = 1; $i <= sizeof($temp); $i++){
                                    if($i === $user->level_id) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                                    else echo "<option value='$i'>".$temp[$i-1]."</option>";
                                }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="creator_id">ID Creator <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="creator_id" class="form-control col-md-7 col-xs-12" name="creator_id" required="required" type="number" value="{{ $user->creator_id }}">
                        </div>
                      </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="<?php echo url('user/show') ?>" class="btn btn-primary">Cancel</a>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                    <?php echo Form::close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop