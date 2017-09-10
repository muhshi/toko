@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
	<div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>User Report <small>Activity report</small></h2>
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
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="<?php echo asset('storage/app/images/').'/'?>{{Auth::user()->foto}}" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3>{{ Auth::user()->name }}</h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-envelope-o user-profile-icon"></i> {{Auth::user()->email}}
                </li>
              </ul>

              <a class="btn btn-success" href="{{ url('profil/edit') }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
              
              <!-- Small modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Lapor</button>

                  <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Lapor Realisasi Harian</h4>
                        </div>
                        <div class="modal-body">
                          <h4>Realisai</h4>
                        {{ Form::open(array('novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                            <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="seksi">Seksi <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <select id="seksi" class="form-control" name="seksi">
                                <option value="-1">Pilih Seksi</option>
                                
                                </select>
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-8 col-xs-12" for="survei">Nama Survei <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-6 col-xs-12" id="survei">
                                  <select id="survei" class="form-control" name="survei">
                                    <option value="-1" disabled>Pilih Seksi</option>
                                    <?php // Form::select('seksi', $seksi, null, array('id' => 'sSeksi', 'class'=>'form-control'))  ?>
                                    
                                </select>
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-4 col-sm-8 col-xs-12" for="survei">Realisasi Hari Ini <span class="required">*</span>
                              </label>
                              <div class="col-md-8 col-sm-6 col-xs-12" id="realisasi">
                                  <input type="number" name="realisasi" class="form-control">
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="send" type="submit" class="btn btn-success">Submit</button>
                              </div>
                            </div>

                        <?php echo Form::close() ?>
                          
                          <p>Tanggal</p> <?php 
                          date_default_timezone_set("Asia/Bangkok");
                          echo "" . date("Y-m-d h:i:sa"); ?>
                          
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->

              <br />

              

            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

              <div class="profile_title">
                <div class="col-md-6">
                  <h2>Grafik Target dan Realisai {{ Auth::user()->name }}</h2>
                </div>
              </div>
              <!-- start of user-activity-graph -->
              <div id="echart_bar_horizontal" style="height:350px;"></div>
              <!-- end of user-activity-graph -->
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script src="<?php echo asset('public/js/morris.min.js') ?>"></script>
<script src="<?php echo asset('public/js/echarts.min.js') ?>"></script>
<script src="<?php echo asset('public/js/raphael.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#seksi').change(function(){

      $('#survei').html("<p>loading...</p>");
      var id = $(this).val();
      //alert('<?php echo url('profil/survei?id='); ?>'+id);
        $('#survei').load('<?php echo url('profil/survei?id='); ?>'+id);

    });

  });
</script>
<script>
      var theme = {
          color: [
              '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
              '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
              itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#408829'
              }
          },

          dataRange: {
              color: ['#1f610a', '#97b58d']
          },

          toolbox: {
              color: ['#408829', '#408829', '#408829', '#408829']
          },

          

          dataZoom: {
              dataBackgroundColor: '#eee',
              fillerColor: 'rgba(64,136,41,0.2)',
              handleColor: '#408829'
          },
          grid: {
              borderWidth: 0
          },

          categoryAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },

          valueAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitArea: {
                  show: true,
                  areaStyle: {
                      color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },
          timeline: {
              lineStyle: {
                  color: '#408829'
              },
              controlStyle: {
                  normal: {color: '#408829'},
                  emphasis: {color: '#408829'}
              }
          },

          textStyle: {
              fontFamily: 'Arial, Verdana, sans-serif'
          }
      };

      

      var echartBar = echarts.init(document.getElementById('echart_bar_horizontal'), theme);

      echartBar.setOption({
        title: {
          text: 'Target',
          subtext: 'Target dan realisasi Seluruh Survei Bulanan'
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          x: 100,
          data: ['Target', 'Realisasi']
        },
        toolbox: {
          show: true,
          feature: {
            saveAsImage: {
              show: true,
              title: "Save Image"
            }
          }
        },
        calculable: true,
        xAxis: [{
          type: 'value',
          boundaryGap: [0, 0.01]
        }],
        yAxis: [{
          type: 'category',
          data: [
          ]
        }],
        series: [{
          name: 'Target',
          type: 'bar',
          data: [
          ]
          }, {
          name: 'Realisasi',
          type: 'bar',
          data: [
          '20','89','80'
          ]
        }]
      });

    </script>
@stop