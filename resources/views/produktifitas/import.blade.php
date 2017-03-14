@extends('master')

@section('main')

<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Input Data Produktivitas</h2>
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

        @if(Auth::user()->role == 1 || Auth::user()->role == 2 )

        {{ Form::open(array('action' => 'ProduktifitasController@upload', 'enctype' => "multipart/form-data", 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="seksi">Seksi <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="survei">Nama Survei <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="survei">
                    <select id="survei" class="form-control" name="survei1">
                      <option value="-1" disabled>Pilih Seksi</option>
                      <?php // Form::select('seksi', $seksi, null, array('id' => 'sSeksi', 'class'=>'form-control'))  ?>
                      
                  </select>
                </div>
              </div>

	        <div class="item form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produktifitas">Pilih File
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input id="produktifitas" class="form-control col-md-7 col-xs-12" name="produktifitas" type="file"">
		        </div>
		    </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                  <a href="<?php echo asset('public/csv/produktifitas.csv') ?>" type="button" class="btn btn-success" style="float: right;">Download Template</a>
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#seksi').change(function(){
      $('#survei').html("<p>loading...</p>");
      var id = $(this).val();
        $('#survei').load('<?php echo url('produktifitas/ajax?id='); ?>'+id);
    });

  });
</script>
@stop