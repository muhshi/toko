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

          @if(Auth::user()->level_id == 1)

          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
              </p>

              <table id="datatable-keytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>No HP</th>
                    <th>Email</th>
                    <th>Level ID</th>
                    <th>Action</th>
                  </tr>
                </thead>


                <tbody>
                @if(!empty($user_list))
                  <?php foreach($user_list as $user): ?>
                  <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->level_id }}</td>
                    <td>
                      <div class="row center">
                        <div class="box-button col-md-4 col-sm-12">
                          <center><a href="<?php echo $user->id ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></center>
                        </div>
                        <div class="box-button col-md-4 col-sm-12">
                          <center><a href="<?php echo url("user/edit/".$user->id) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a></center>
                        </div>
                        <div class="box-button col-md-4 col-sm-12">
                          <center>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['UserController@delete', $user->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm', 'id' => 'confirm']) !!}
                            {!! Form::close() !!}
                          </center>
                        </div>
                      </div>
                      <!-- <a href="<?php echo $user->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a> -->
                    </td>
                  </tr>
                  <?php endforeach ?>
                @else
                    <p> Tidak ada data user</p>
                @endif
                </tbody>
              </table>

              <div>
                <a href="<?php echo 'create' ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah user </a>
              </div>
            </div>
          </div>

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

<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script>
  $(document).ready(function(){
    $('.confirm').click(function(){
      confirm('Apakah Anda Yakin Untuk Menghapus data ini?');
    });
  });
</script>

@stop