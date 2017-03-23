<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Jadwal;
use App\Seksi;
use App\Responden;
use Input;
use App\Survei;
use Redirect;

class JadwalController extends Controller {

    public $input;

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $username = Auth::user()->username;
        $halaman = "jadwal";
        $data = ['halaman' => $halaman];
        $survei = DB::select("SELECT survei.nama_survei, target.dateline FROM pegawai pegawai inner join survei survei inner join target target WHERE  pegawai.username = '".$username."' AND target.nip = pegawai.nip AND survei.id=target.survei_id");
        $dateline = DB::select("SELECT survei.nama_survei, target.dateline FROM pegawai,survei,target WHERE  pegawai.username = '".$username."' AND target.nip = pegawai.nip AND survei.id=target.survei_id");
        return view("jadwal/index", compact('survei', 'dateline'), $data);
    }

    public function jadwal() {
        $username = Auth::user()->username;
        $halaman = "jadwal";
        $data = ['halaman' => $halaman];
        $survei_id = Input::get('survei');
        if ($survei_id == '') {
            $survei_id = 'target.survei_id';
        }
        $seksi = Seksi::all();
        $survei = DB::select("SELECT pegawai.nama, survei.nama_survei, target.dateline, target.target, target.realisasi FROM pegawai pegawai inner join survei survei inner join target target WHERE target.nip = pegawai.nip AND survei.id = target.survei_id AND survei.id = $survei_id ORDER BY 'pegawai', 'nama'");
        return view("jadwal/jadwal", compact('survei','seksi'), $data);
    }

    public function survei() {
        $id = $_GET['id'];
        $survei = DB::select("SELECT * FROM survei WHERE seksi_id = $id ");

        echo '<select id="survei" class="form-control" name="survei[]">
        <option value="-1" disabled>Pilih Survei</option>';
                      
        foreach($survei as $sur){
            echo "<option value='".$sur->id."'>".$sur->nama_survei."</option>";
        }

        echo '</select>';
    }

    public function csv(){

        $table = Responden::all();

        $csv = $_SERVER['DOCUMENT_ROOT']."/survei.csv";
        
       
        $file = fopen($csv, 'w');
        foreach ($table as $row) {
            fputcsv($file,explode('":',$row));
        }
        fclose($file);

        //print_r($csv);
    }

    public function responden(){

        $dset = $_GET['dset'];
        
//        $survei = $request->input('survei');
//        $survei = $_POST['survei'];
//        $jml_responden = Input::get('jml_responden');
//        $dateline = Input::get('dateline');

        $i = 0;
        $responden = new Responden();

        $hasil = explode(";", $dset);
        print_r($hasil);
        
        $csv = 'D:/survei.csv';
        $file = fopen($csv, 'w');
        
        $hasil1 = array();
        foreach($hasil as $x){
            $temp = explode(",", $x);
            //fputcsv($file, $temp);
            $hasil1[] = $temp;
        }

        // matrix kebalik, perlu di transpose
        array_unshift($hasil1, null);
        $hasil2 = call_user_func_array('array_map', $hasil1);

        foreach($hasil2 as $x){
            fputcsv($file, $x);
        }

        return back()
                    ->with('success','Data Berhasil Disimpan di D:/survei.csv');

    }



    public function pilih_pegawai(){

        $pegawai = DB::select('SELECT nama FROM pegawai');
        $jml_peg = DB::select('SELECT COUNT(nama) FROM pegawai;');
        
        foreach ($pegawai as $peg) {
            $i = 1;
                echo '<tr>';
                echo '<td><input type="checkbox" class="flat" name="table_records"></td>';
                echo "<td>".$peg->nama."</td>";
                echo "<td> null </td>";
                echo '</tr>';
            $i++;
        }
    }

    public function pilih_pegawai1(){

        echo('<tr class="odd"> <td valign="top" colspan="3" class="dataTables_empty"> Tidak Adak Pegawai Yang Dipilih</td> </tr>');
    }

}
