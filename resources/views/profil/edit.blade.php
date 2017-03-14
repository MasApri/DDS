@extends('master')

@section('main')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
          <h2>Edit Profil Pegawai</h2>
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

        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12" style="color: white;">
              <a>.</a>
            </div>
            <div class="col-md-6">
              <div class="" >
                <img id="foto" src="<?php echo asset('storage/app/images/').'/'?>{{Auth::user()->foto}}" alt="your image" style="width: 250px; margin-bottom: 30px;"/>  
              </div>
            </div>
        </div>

        {{ Form::open(array('action' => 'ProfilController@upload', 'enctype' => "multipart/form-data", 'runat' => "server", "id" => 'form_saya', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                      
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Foto Profil
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="imgInp" class="form-control col-md-7 col-xs-12" name="foto" type="file" value="{{Auth::user()->foto}}">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="nama" class="form-control col-md-7 col-xs-12" data-validate-length-range="3"  name="name" required="required" type="text" value="<?php echo Auth::user()->name ?>">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="username" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="username" required="required" type="text" value="<?php echo Auth::user()->username ?>">
                </div>
              </div>

              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="email" class="form-control col-md-7 col-xs-12" name="email" type="email" value="<?php echo Auth::user()->email ?>">
                </div>
            </div>

              <div class="item form-group">
                <label for="password" class="control-label col-md-3">Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                </div>
              </div>
              <div class="item form-group">
                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="confirm_password" type="password" name="confirm_password" data-validate-linked="password" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-3">
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