@extends('master')

@section('main')

<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Input Data Survei</h2>
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

        <span class="section">Edit Profil Pegawai</span>

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

        @if(Auth::user()->role == 1)

        {{ Form::open(array('action' => 'BebanController@upload', 'enctype' => "multipart/form-data", 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}

          <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="tahun">
                        <option value="-1" disabled>Pilih Tahun</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
            </div>

        	<div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bulan">Bulan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" name="bulan">
                        <option value="-1" disabled>Pilih Bulan</option>
                        <option value="januari">Januari</option>
                        <option value="februari">Februari</option>
                        <option value="maret">Maret</option>
                        <option value="april">April</option>
                        <option value="mei">Mei</option>
                        <option value="juni">Juni</option>
                        <option value="juli">Juli</option>
                        <option value="agustus">Agustus</option>
                        <option value="september">September</option>
                        <option value="oktober">Oktober</option>
                        <option value="november">November</option>
                        <option value="desember">Desember</option>
                    </select>
                </div>
            </div>

	        <div class="item form-group">
		        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="target">Pilih File
		        </label>
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <input id="target" class="form-control col-md-7 col-xs-12" name="target" type="file"">
		        </div>
		    </div>

              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
                  <button id="send" type="submit" class="btn btn-success">Submit</button>
                  <a href="<?php echo asset('public/csv/target.csv') ?>" type="button" class="btn btn-success" style="float: right;">Download Template</a>
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