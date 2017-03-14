<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Target;
use Redirect;
use Input;

class BebanController extends Controller {

    public function beban_ramal_ga() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
//        return view('pages/beban', $data);
        return view('beban/beban_ramal_ga', $data);
    }

    public function beban_ramal_bobot() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
//        return view('pages/beban', $data);
        return view('beban/beban_ramal_bobot', $data);
    }

    public function beban_bagi_rata() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
//        return view('pages/beban', $data);
        return view('beban/beban_bagi_rata', $data);
    }

    public function import() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
        return view('beban.import', $data);
    }

    public function show() {
        $halaman = "beban";
        $data = ['halaman' => $halaman];
        $target = Target::all();
        $tahun = DB::select("SELECT tahun FROM target LIMIT 1");
        return view('beban.show', compact('target', 'tahun'), $data);
    }

    public function upload(Request $request) {

        $post = $request->request->all();

        $file = $request->file('target');
        $file = $request->target;


        $nama_file = $_FILES['target']['name'];
        //echo 'upload file name : '.$nama_file.' ';
        $chk_ext = explode('.', $nama_file);

        if (strtolower(end($chk_ext)) == 'csv') {

            $filename = $_FILES['target']['tmp_name'];
            $handle = fopen($filename, "r");

            $i = 0;
            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $i = $i + 1;
                if ($i == 1)
                    continue;


                /* for($i = 0; $i<14; $i++){
                  if($data[$i] == ""){
                  $data[$i] = "";
                  }else{
                  $data[$i] = $data[$i];
                  }
                  } */

                $target = new Target();
                $bulan = Input::get('bulan');
                $tahun = Input::get('tahun');

                $nip = preg_replace("/[^0-9]/", "", $data[1]);
//                $nip = str_replace("~", "", $data[1]);

                $cek = DB::select("SELECT nip,tahun FROM target WHERE nip='" . $nip . "' AND tahun = " . $tahun . " AND bulan = '" . $bulan . "' AND survei_id = '" . $data[2] . "'");

                $ada = FALSE;
                foreach ($cek as $x) {
                    $ada = TRUE;
                }

                if ($ada) {
                    $update = DB::update("UPDATE target SET nip = '" . $nip . "', tahun= '" . $tahun . "', bulan = '" . $bulan . "' WHERE nip=" . $nip . " AND tahun =" . $tahun . "");
                } else {

//                                    $target->nip = $data[0];
//			            $target->tahun = $tahun;
//			            $target->bulan = $bulan;
//			            $target->survei_id = $data[1];
//			            $target->target = $data[2];
//			            $target->dateline = $data[3];
//			            $target->save();
//						$insert = DB::insert("INSERT INTO ckpr ( nip, tahun, ".$bulan.") VALUES (".$data[0].", ".$data[1].", ".$data[2].")");

                    DB::insert("INSERT INTO `target`(`tahun`, `bulan`, `nip`, `survei_id`, `target`, `dateline`, `realisasi`) VALUES "
                            . "($tahun,'$bulan',$nip,$data[2],$data[3],$data[4],0)");
                }
            }

            fclose($handle);
            return back()
                            ->with('success', 'Import successful.');
            echo "file sudah di import";
        } else {
            echo "File invalid";
        }
        return Redirect::to('beban/import');
    }

}
