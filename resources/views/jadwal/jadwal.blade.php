@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Pilih Survei</h2>
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

              {{ Form::open(array('action' => 'JadwalController@jadwal', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                <div class="item form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="seksi">Seksi <span class="required">*</span>
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <select id="seksi" class="form-control" name="seksi">
                    <option value="-1">Pilih Seksi</option>
                    <?php // Form::select('seksi', $seksi, null, array('id' => 'sSeksi', 'class'=>'form-control'))  ?>
                    <?php foreach($seksi as $x): ?>
                      <option value="{{ $x->id }}">{{ $x->seksi }}</option>

                    <?php endforeach ?>
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

                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>

            <?php echo Form::close() ?>

              </div>
            </div>
          </div>  
        <div class="col-md-8 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    <h2>Jadwal Untuk {{ Auth::user()->name }}</h2>
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

                  <div class="col-md-12 col-sm-12">
                        <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Nama Survei</th>
                                <th>Target</th>
                                <th>Realisasi</th>
                                <th>Dateline</th>
                            </tr>
                        </thead>


                        <tbody>
                            @if(!empty($survei))
                            <?php foreach ($survei as $survei): ?>
                                <tr>
                                    <td>{{ $survei->nama }}</td>
                                    <td>{{ $survei->nama_survei }}</td>
                                    <td>{{ $survei->target }}</td>
                                    <td>{{ $survei->realisasi }}</td>
                                    <td>{{ $survei->dateline }}</td>
                                </tr>
                            <?php endforeach ?>
                            @else
                        <p> Tidak ada data jadwal</p>
                        @endif
                        </tbody>
                    </table>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#seksi').change(function(){

      $('#survei').html("<p>loading...</p>");
      var id = $(this).val();
      //alert('<?php echo url('monitoring/survei?id='); ?>'+id);
        $('#survei').load('<?php echo url('monitoring/survei?id='); ?>'+id);

    });

  });
</script>
@stop