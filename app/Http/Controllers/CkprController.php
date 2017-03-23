<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use Input;
use App\CKPR;

class CkprController extends Controller {

    public function import() {
        $halaman = "ckpr";
        $data = ['halaman' => $halaman];
        return view('ckpr.importcsv', $data);
    }

    public function show() {
        $halaman = "ckpr";
        $data = ['halaman' => $halaman];
        $tahun = Input::get('tahun'); 
        if($tahun == ''){
            $tahun = "''";
        }
        $ckpr = DB::select("SELECT pegawai.nama, ckpr.* FROM ckpr, pegawai WHERE ckpr.nip=pegawai.nip AND ckpr.tahun = $tahun");
        return view('ckpr.show', compact('ckpr', 'tahun'), $data);
    }

    public function upload(Request $request) {

        $post = $request->request->all();

        $file = $request->file('ckpr');
        $file = $request->ckpr;

        $nama_file = $_FILES['ckpr']['name'];
        //echo 'upload file name : '.$nama_file.' ';
        $chk_ext = explode('.', $nama_file);

        if (strtolower(end($chk_ext)) == 'csv') {

            $filename = $_FILES['ckpr']['tmp_name'];
            $handle = fopen($filename, "r");

            while (($data = fgetcsv($handle, null, ";")) !== FALSE) {
                if ($data[0] != 'nip') {
                    /* for($i = 0; $i<14; $i++){
                      if($data[$i] == ""){
                      $data[$i] = "";
                      }else{
                      $data[$i] = $data[$i];
                      }
                      } */
                    
                    $data[0] = preg_replace("/[^0-9]/","",$data[0]);

                    $ckpr = new CKPR();
                    $bulan = Input::get('bulan');
                    $tahun = Input::get('tahun');
                    $cek = DB::select("SELECT nip,tahun,".$bulan." FROM ckpr WHERE nip=" . $data[0] . " AND tahun = " . $tahun . " AND ".$bulan." = ".$bulan);

                    $ada = FALSE;
                    foreach ($cek as $x) {
                        $ada = TRUE;
                    }

                    if ($ada) {
                        $update = DB::update("UPDATE ckpr SET nip = '" . $data[0] . "', tahun= '" . $tahun . "', " . $bulan . " = '" . $data[2] . "' WHERE nip=" . $data[0] . " AND tahun =" . $tahun . "");
                    } else {

                        $ckpr->nip = $data[0];
                        $ckpr->tahun = $tahun;
                        $ckpr->$bulan = $data[2];
                        $ckpr->save();
                        //$insert = DB::insert("INSERT INTO ckpr ( nip, tahun, ".$bulan.") VALUES (".$data[0].", ".$data[1].", ".$data[2].")");
                    }
                }
            }

            fclose($handle);
            return back()
                            ->with('success', 'Import successful.');
            echo "file sudah di import";
        } else {
            echo "File invalid";
        }
        return Redirect::to('ckpr/import');
    }

}
