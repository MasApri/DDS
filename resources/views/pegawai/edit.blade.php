@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Input Data Pegawai</h2>
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
                    {{ Form::open(array('action' => 'PegawaiController@update', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                    <span class="section">Data Pegawai</span>

                    <input type="hidden" name="id" value="<?php echo $pegawai->id ?>">
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nama" placeholder="misal: warkito" required="required" type="text" value="<?php echo $pegawai->nama ?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">NIP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="nip" class="form-control col-md-7 col-xs-12" data-validate-length-range="18,18" name="nip" placeholder="NIP" required="required" type="number" value="<?php echo $pegawai->nip ?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="jabatan">
                                <option value="-1" disabled>Pilih Jabatan</option>
                                
                                <?php
                                    $temp = ["Kepala BPS", "KASI", "Staff/KSK"];
                                    for($i = 1; $i <= sizeof($temp); $i++){
                                        if($i === $pegawai->jabatan) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                                        else echo "<option value='$i'>".$temp[$i-1]."</option>";
                                    }
                                ?>

                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tingkat Pendidikan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" name="tingkat_pendidikan_id">
                                <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                                <?php
                                    $temp = ["Tidak Sekolah", "SD/MI/SR", "SMP/MTS", "SMA/MA", "DI/DII/DIII", "DIV/SI", "SII/SIII"];
                                    for($i = 1; $i <= sizeof($temp); $i++){
                                        if($i === $pegawai->tingkat_pendidikan_id) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                                        else echo "<option value='$i'>".$temp[$i-1]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="email" placeholder="misal: warkito@email.com" required="required" type="email" value="<?php echo $pegawai->email ?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="username"  required="required" type="text" value="<?php echo $pegawai->username ?>">
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ketepatan Waktu</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="ketepatan_waktu">
                            <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                            <?php
                                $temp = ["Sangat Tepat", "Cukup Tepat", "Tepat Waktu", "Terlambat", "Sangat Terlambat"];
                                for($i = 1; $i <= sizeof($temp); $i++){
                                    if($i === $pegawai->ketepatan_waktu) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                                    else echo "<option value='$i'>".$temp[$i-1]."</option>";
                                }
                            ?>
                          </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pengalaman">Nilai Pengalaman <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="nilai_pengalaman">
                            <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                            <?php
                                $temp = ["Sangat Ahli", "Ahli", "Sedang", "Kurang", "Tidak Ahli"];
                                for($i = 1; $i <= sizeof($temp); $i++){
                                    if($i === $pegawai->nilai_pengalaman) echo "<option value='$i' selected>".$temp[$i-1]."</option>";
                                    else echo "<option value='$i'>".$temp[$i-1]."</option>";
                                }
                            ?>
                          </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="<?php echo url('pegawai/show') ?>" class="btn btn-primary">Cancel</a>
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