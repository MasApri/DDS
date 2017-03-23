<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Seksi;
use App\Survei;
use App\Produktifitas;
use Redirect;
use Input;

class ProduktifitasController extends Controller
{
    public function import()
    {
    	$halaman = "produktifitas";
        $data = ['halaman' => $halaman];
        $seksi = Seksi::all();
        return view('produktifitas/import',compact('seksi'), $data);
    }

    public function survei() {
        $id = $_GET['id'];
        $survei = DB::select("SELECT * FROM survei WHERE seksi_id = $id ");

        echo '<select id="survei" class="form-control" name="survei1">
        <option value="-1" disabled>Pilih Survei</option>';
                      
        foreach($survei as $sur){
            echo "<option value='".$sur->id."'>".$sur->nama_survei."</option>";
        }

        echo '</select>';
    }

    public function show(){
    	$halaman = "produktifitas";
        $data = ['halaman' => $halaman];
        $seksi = Seksi::all();
        $survei_id = Input::get('survei');
        if ($survei_id == '') {
            $survei_id = "''";
        }
        $produktifitas = DB::select("SELECT pegawai.nama, pegawai.nip, produktifitas.produktifitas FROM pegawai, produktifitas WHERE produktifitas.survei = $survei_id ");
        //SELECT seksi.seksi, pegawai.nama, survei.nama_survei, produktifitas.produktifitas, produktifitas.bulan, produktifitas.tahun FROM seksi, survei, produktifitas, pegawai WHERE produktifitas.nip = pegawai.nip AND produktifitas.seksi = seksi.id  AND produktifitas.survei = survei.id
        return view('produktifitas.show', compact('produktifitas','seksi'), $data);
    }

    public function upload(Request $request){

    	$post = $request->request->all();
        $file = $request->file('produktifitas');
        $file = $request->produktifitas;


        $nama_file = $_FILES['produktifitas']['name'];
		//echo 'upload file name : '.$nama_file.' ';
		$chk_ext = explode('.', $nama_file);

		if(strtolower(end($chk_ext)) == 'csv'){

			$filename = $_FILES['produktifitas']['tmp_name'];
			$handle = fopen($filename, "r");

			while (($data = fgetcsv($handle, null, ";")) !== FALSE){
				if($data[0] != 'nip'){
                                    
                    $data[0] = preg_replace("/[^0-9]/","",$data[0]);
                                    
					$produktifitas = new Produktifitas();
					$seksi = Input::get('seksi');
					$survei = Input::get('survei1');
					$cek  = DB::select("SELECT nip,seksi,survei FROM produktifitas WHERE nip='".$data[0]."' AND survei = '".$survei."'");

					$ada = FALSE;
					foreach($cek as $x){
						$ada = TRUE;
					}

					if($ada){
						$update = DB::update("UPDATE produktifitas SET produktifitas = ".$data[1]."  WHERE nip=".$data[0]." AND survei =".$survei."");
					}else{

						$produktifitas->nip = $data[0];
			            $produktifitas->seksi = $seksi;
			            $produktifitas->survei = $survei;
			            $produktifitas->produktifitas = $data[1];
			            $produktifitas->save();
						//$insert = DB::insert("INSERT INTO ckpr ( nip, tahun, ".$bulan.") VALUES (".$data[0].", ".$data[1].", ".$data[2].")");
					}
				}
			}

			fclose($handle);
			return back()
    				->with('success','Import successful.');
			echo "file sudah di import";
		}
		else{
			echo "File invalid";
		}
		return Redirect::to('produktifitas/import');
    }
}
