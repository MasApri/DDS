<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Jadwal;
use App\Seksi;
use App\Survei;
use App\Target;
use Input;
use Session;
use Auth;

class MonitoringController extends Controller {

    public function index() {
        $halaman = "monitoring";
        $data = ['halaman' => $halaman];
        $seksi = Seksi::all();
        $survei = Target::all();
        $email = Auth::user()->email;



        $nip = DB::table('pegawai')->select('nip')->where('email', $email)->first();
        $nip = $nip->nip;

        $target = DB::select("SELECT target FROM target WHERE nip=$nip");
        $realisasi = Target::all();
        $survei = DB::select("SELECT survei.nama_survei FROM survei, target WHERE target.survei_id=survei.id AND target.nip=$nip");

        return view('monitoring/monitoring', compact('seksi', 'pegawai', 'survei', 'target', 'realisasi'), $data);
    }

    public function dateline() {
        $halaman = "monitoring";
        $data = ['halaman' => $halaman];
//        $hasil = DB::select('select * from su');
//        return view('monitoring/dateline', $data);

        $email = Auth::user()->email;
        $nip = DB::table('pegawai')->select('nip')->where('email', $email)->first();
        $nip = $nip->nip;

        $dateline = DB::select("select a.*, b.nama_survei from target a inner join survei b where a.nip = '$nip' and b.id = a.survei_id");

        return view('monitoring/dateline', compact('dateline'), $data);
    }

    public function survei() {
        $halaman = "monitoring";
        $data = ['halaman' => $halaman];
        $survei_id = Input::get('survei');
        $seksi = Seksi::all();
        $survei = DB::select('SELECT nama_survei FROM survei WHERE id =' . $survei_id);
        $target = DB::select('SELECT target FROM target WHERE survei_id =' . $survei_id);
        $pegawai = DB::select('SELECT pegawai.nama FROM pegawai, target WHERE pegawai.nip = target.nip AND survei_id =' . $survei_id);
        return view('monitoring/pegawai', compact('survei', 'seksi', 'target', 'pegawai'), $data);
    }

    public function ajax() {
        $id = $_GET['id'];
        $survei = DB::select("SELECT * FROM survei WHERE seksi_id = $id ");

        echo '<select id="survei" class="form-control" name="survei">
        <option value="-1" disabled>Pilih Survei</option>';

        foreach ($survei as $sur) {
            echo "<option value='" . $sur->id . "'>" . $sur->nama_survei . "</option>";
        }

        echo '</select>';
    }

}
