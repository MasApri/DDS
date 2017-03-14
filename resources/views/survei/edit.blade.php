
<?php $halaman = "edit" ?>

@extends('master')

@section('main')

<!--<script>
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-3d'
    });
</script>-->

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
                    {{ Form::open(array('action' => 'SurveiController@update', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                    <input type="hidden" name="id" value="<?php echo $survei->id ?>">
                    <span class="section">Data Survei</span>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Seksi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="seksi_id">
                            <option value="-1" disabled>Pilih Seksi</option>
                            <?php
                                $temp = ['Sosial', 'Neraca Wilayah dan Analisis', 'Produksi', 'Distribusi', 'IPDS'];
                                for ($i = 1; $i <= sizeof($temp); $i++) {
                                    if ($i === $survei->jenis_survei_id)
                                        echo ("<option value=" . $i . " selected>" . $temp[$i - 1] . "</option>");
                                    else
                                        echo("<option value=" . $i . ">" . $temp[$i - 1] . "</option>");
                                }
                            ?>
                          </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_survei">Nama Survei<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nama_survei" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nama_survei" placeholder="misal: warkito" required="required" type="text" value="<?php echo $survei->nama_survei ?>">
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pendekatan Unit Sampel</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="pendekatan_unit_sampel">
                                <option value="-1" disabled>Pilih Pendekatan Unit Sampel</option>
                                <?php
                                $temp = ['Rumah Tangga', 'Unit Usaha/Perusahaan'];
                                for ($i = 1; $i <= sizeof($temp); $i++) {
                                    if ($i === $survei->pendekatan_unit_sampel)
                                        echo ("<option value=" . $i . " selected>" . $temp[$i - 1] . "</option>");
                                    else
                                        echo("<option value=" . $i . ">" . $temp[$i - 1] . "</option>");
                                }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Indeks Kesulitan Survei</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="indeks_kesulitan_id">
                                <option value="-1" disabled>Pilih Indeks Kesulitan Survei</option>
                                <?php
                                $temp = ['Sangat Sulit', 'Sulit', 'Sedang', 'Mudah', 'Sangat Mudah'];
                                for ($i = 1; $i <= sizeof($temp); $i++) {
                                    if ($i === $survei->indeks_kesulitan_id)
                                        echo ("<option value=" . $i . " selected>" . $temp[$i - 1] . "</option>");
                                    else
                                        echo("<option value=" . $i . ">" . $temp[$i - 1] . "</option>");
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mulai">Waktu Selesai<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" name="waktu_selesai" id="single_cal2" placeholder="Waktu Selesai" aria-describedby="inputSuccess2Status" required="required" value="<?php //echo $survei->waktu_selesai ?>">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>
                    -->
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="<?php echo url("survei/show") ?>" class="btn btn-primary">Cancel</a>
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