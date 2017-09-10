@extends('master')

@section('main')

<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#foto').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); 
        }
    }

    $(document).ready(function () {
        $("#imgInp").change(function () {

            readURL(this);
        });
    });

</script>

<script>
    $(document).ready(function () {

        $("#form_saya").submit(function (submitEvent) {
            var keputusan = "kirim";

            // get the file name, possibly with path (depends on browser)
            var filename = $('#imgInp').val();

            if (filename != "") {
                // Use a regular expression to trim everything before final dot
                var extension = filename.replace(/^.*\./, '');

                // Iff there is no dot anywhere in filename, we would have extension == filename,
                // so we account for this possibility now
                if (extension == filename) {
                    extension = '';
                } else {
                    // if there is an extension, we convert to lower case
                    // (N.B. this conversion will not effect the value of the extension
                    // on the file upload.)
                    extension = extension.toLowerCase();
                }

                switch (extension) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':


                        // uncomment the next line to allow the form to submitted in this case:
                        break;

                    default:
                        alert("Pastikan format file adalah [jpg, jpeg, png, gif]");
                        // Cancel the form submission
                        keputusan = "abort";

                }
            }

            if (keputusan == "abort") {
                submitEvent.preventDefault();
            }


        });

    });



</script>

<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Input Data Toko </h2>
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

          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12" style="color: white;">
              <a>.</a>
            </div>
            <div class="col-md-6">
              <div class="" >
                <img id="foto" src="" alt="Logo Toko" style="width: 250px; margin-bottom: 30px;"/>  
              </div>
            </div>
        </div>

          @if(Auth::user()->level_id == 1)
          {{ Form::open(array('action' => 'TokoController@update', 'enctype' => "multipart/form-data", 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
            <span class="section">Data user</span>
            <div class="hidden">
              <input id="id" class="form-control col-md-7 col-xs-12" name="id" type="text" value="{{ $toko->id }}">
            </div>
            
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Logo
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="imgInp" class="form-control col-md-7 col-xs-12" name="foto" type="file" value="">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_toko">Nama Toko<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input id="nama_toko" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" name="nama_toko" placeholder="misal: Toko Baju" required="required" type="text" value="{{ $toko->nama_toko }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">Ho HP <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="no_hp" class="form-control col-md-7 col-xs-12" name="no_hp" required="required" type="tel" value=" {{ $toko->no_hp }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Provinsi</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="prov" id="prov">
                  <?php foreach ($prov as $prov) : ?>
                    <option value="{{ $prov->kode_prov }}"> {{ $prov->provinsi }} </option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Kabupaten/Kota</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="kab" id="kab">
                  
                </select>
              </div>
            </div>
            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Kecamatan</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="kec" id="kec" required="required">
                  
                </select>
              </div>
            </div>
            <script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
            <script type="text/javascript">
              $(document).ready(function(){
                $('#prov').change(function(){
                  //alert('masuk sini :'+ ')' + $(this).val());
                    $('#kab').html("<p>loading...</p>");
                    var id = $(this).val();
                      $('#kab').load('<?php echo url('ajax/kab?id='); ?>'+id);
                  });

                  $('#kab').change(function(){
                  //alert('masuk sini');
                    $('#kec').html("<p>loading...</p>");
                    var id = $(this).val();
                      $('#kec').load('<?php echo url('ajax/kec?id='); ?>'+id);
                  });
              });
            </script>


            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control col-md-7 col-xs-12" name="alamat_toko" required="required"> {{ $toko->alamat }}  </textarea>   
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tagline">Tagline</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tagline" class="form-control col-md-7 col-xs-12" name="tagline" type="text" value="{{ $toko->tagline }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="facebook">Facebook </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tagline" class="form-control col-md-7 col-xs-12" name="facebook" type="text" value="{{ $toko->fb }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="twitter">Twitter</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="twitter" class="form-control col-md-7 col-xs-12" name="twitter" type="text" value="{{ $toko->twitter }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instagram">Instagram</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="instagram" class="form-control col-md-7 col-xs-12" name="instagram" type="text" value="{{ $toko->instagram }}">
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cek_transfer">Cek Transfer<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="cek_transfer">
                  <?php
                      $temp = ["On", "Off"];
                      for($i = 1; $i <= sizeof($temp); $i++){
                          if($i == $toko->status) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                          else echo "<option value='$i'>".$temp[$i]."</option>";
                      }
                  ?>
                </select>
              </div>
            </div>

            <div class="item form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="status">
                  <option value="-1" disabled>Pilih Status</option>
                  <?php
                      $temp = ["Aktif", "Off"];
                      for($i = 1; $i <= sizeof($temp); $i++){
                          if($i == $toko->status) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                          else echo "<option value='$i'>".$temp[$i]."</option>";
                      }
                  ?>
                </select>
              </div>
            </div>

            <div class="item form-group hidden">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="creator_id">ID Creator <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="creator_id" class="form-control col-md-7 col-xs-12" name="creator_id" value="{{ Auth::user()->id }}" type="number">
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