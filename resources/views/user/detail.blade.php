@extends('master')

@section('main')
	<div class="right_col" role="main" style="min-height: 300px;">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data user</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
              </p>

              <table id="datatable-keytable" class="table table-striped table-bordered">
                  <tr>
                    <th>Nama</th>
                    <td>{{ $user->name }}</td>
                  </tr>
                  <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                  </tr>
                  <tr>
                    <th>No HP</th>
                    <td>{{ $user->no_hp }}</td>
                  </tr>
                  <tr>
                    <th>ID Level</th>
                    <td>{{ $user->level_id }}</td>
                  </tr>
                  <tr>
                    <th>Status</th>
                    <td>{{ $user->status }}</td>
                  </tr>
                  <tr>
                    <th>ID Creator</th>
                    <td>{{ $user->creator_id }}</td>
                  </tr>
              </table>

              <div>
                <a href="<?php echo 'show' ?>" class="btn btn-primary">Kembali</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop