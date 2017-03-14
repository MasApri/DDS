<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Redirect;
use Session;
use Input;
use App\Target;
use App\Survei;

class LaporanController extends Controller {

    public function index() {
        $halaman = 'laporan';
        $data = ['halaman' => $halaman];

        $email = Auth::user()->email;
        $nip = DB::table('pegawai')->select('nip')->where('email', $email)->first();
        $nip = $nip->nip;

        $survei = DB::select("SELECT survei.nama_survei, target.target, target.realisasi FROM survei, target WHERE target.survei_id = survei.id AND target.nip = '$nip'");
        return view('laporan.index', ['halaman' => $halaman, 'survei' => $survei]);
    }

    public function harian() {
        $halaman = 'laporan';
        $data = ['halaman' => $halaman];
        $email = Auth::user()->email;
        $nip = DB::table('pegawai')->select('nip')->where('email', $email)->first();
        $nip = $nip->nip;

        $hasil = DB::select("SELECT a.nama_survei as nama_survei, b.* FROM survei a inner join target b where a.id = b.survei_id and b.nip = '$nip'");

        return view('laporan.index', ['halaman' => $halaman,"survei" => $hasil]);
    }

    public function detil() {
        
        echo Session::get('message')."<br/>"; 
        
        $id = $_GET['id'];

        $hasil = DB::select("SELECT a.nama_survei as nama_survei, b.* FROM survei a inner join target b where a.id = b.survei_id and b.id = $id");

        foreach ($hasil as $x) {
            $survei = $x->nama_survei;
            $survei_id = $x->survei_id;
            $bulan = $x->bulan;
            $tahun = $x->tahun;
            $target = $x->target;
            $realisasi = $x->realisasi;
            $dateline = $x->dateline;
        }

        $email = Auth::user()->email;
        $nip = DB::table('pegawai')->select('nip')->where('email', $email)->first();
        $nip = $nip->nip;

        $hasil = DB::select("select produktifitas from produktifitas where survei = $survei_id and nip = '$nip' order by id desc limit 1");

        $produktifitas = 0;
        foreach($hasil as $x){
            $produktifitas = $x->produktifitas;
        }
        
        $hasil = DB::select("select * from catatan_harian where id_target = $id order by hari_ke");
        
        return view('laporan.detil', [
            "id" => $id,
            "nip" => $nip,
            "survei" => $survei,
            "survei_id" => $survei_id,
            "bulan" => $bulan,
            "tahun" => $tahun,
            "target" => $target,
            "realisasi" => $realisasi,
            "dateline" => $dateline,
            "produktifitas" => $produktifitas,
            "target_harian" => $hasil
                
        ]);

    }
    
    public function edit_harian(){
        $input = Input::all();
        extract($input);
        
        $affected = DB::insert("INSERT INTO `catatan_harian`(`id_target`, nip, `hari_ke`, `realisasi`) VALUES (?,?,?,?)", [$id_target, $nip, $hari_ke, $realisasi]);
        $affected1 = DB::update("UPDATE `target` SET `realisasi`= (select sum(realisasi) from catatan_harian where nip='$nip') WHERE survei_id = ? and nip = ?", [$survei_id, $nip]);
        
        
        return Redirect::back()->with('message','Operation Successful !');
    }

}
