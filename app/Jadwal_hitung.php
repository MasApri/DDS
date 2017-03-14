<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

//use App\Eloquent;

class Jadwal_hitung extends Eloquent {

    public function get_all_survei_id() {
        $survei_id = DB::select("select id from survei");
        return ($survei_id);
    }

    public function get_jumlah_responden_jabatan($survei_id) {

        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, jabatan_fungsional FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);


        $pegawai_id = [];
        $nama_pegawai = [];
        $jabatan_fungsional = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $jabatan_fungsional[] = $x->jabatan_fungsional;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        $total = 0;
        foreach ($hasil1 as $x) {
            $total = $total + $x->jabatan_fungsional;
        }

        $bobot = [];
        foreach ($hasil1 as $x) {
            $bobot[] = $x->jabatan_fungsional / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "jabatan_fungsional" => $jabatan_fungsional,
            "total" => $total,
            "bobot" => $bobot,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }

    public function get_jumlah_responden_keterlibatan_survei($survei_id) {
        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, keterlibatan_survei FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);
        $total = 0;

        $pegawai_id = [];
        $nama_pegawai = [];
        $skor = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $skor[] = $x->keterlibatan_survei;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        # menghitung range

        $temp = DB::select("SELECT MAX(keterlibatan_survei) as tertinggi, MIN(keterlibatan_survei) as terendah FROM `kuesioner_pegawai` WHERE survei_id= ?", [$survei_id]);
        $tertinggi = $temp[0]->tertinggi;
        $terendah = $temp[0]->terendah;
        unset($temp);

        $R = $tertinggi - $terendah;
//        unset($tertinggi);
//        unset($terendah);

        $N = sizeof($pegawai_id);
        $K = ceil(1 + 3.33 * log10($N));
        $I = ceil($R / $K);

//        echo "I: ".$I."<hr/>";
//        
//        foreach($hasil1 as $x){
//            print_r($x);
//            echo "<hr/>";
//        }

        $batas_bawah = range(1, $K);
        $batas_atas = range(1, $K);

        $batas_bawah[0] = $terendah;
        $batas_atas[0] = $batas_bawah[0] + $I - 1;

        for ($i = 1; $i < $K; $i++) {
            $batas_bawah[$i] = $batas_atas[$i - 1] + 1;
            $batas_atas[$i] = $batas_bawah[$i] + $I - 1;
        }

        $nilai_index = [];

        foreach ($skor as $x) {

            for ($i = 0; $i < $K; $i++) {
                if ($x >= $batas_bawah[$i] && $x <= $batas_atas[$i]) {
                    $nilai_index[] = $i + 1;
                    break;
                }
            }
        }

        $total = 0;
        foreach ($nilai_index as $x) {
            $total = $total + $x;
        }

        $bobot = [];
        foreach ($nilai_index as $x) {
            $bobot[] = $x / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "keterlibatan_survei" => $skor,
            "indeks" => $nilai_index,
            "bobot" => $bobot,
            "total" => $total,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }

    public function get_jumlah_responden_jarak($survei_id) {
        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, jarak FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);


        $pegawai_id = [];
        $nama_pegawai = [];
        $jarak = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $jarak[] = $x->jarak;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        $total = 0;
        foreach ($hasil1 as $x) {
            $total = $total + $x->jarak;
        }

        $bobot = [];
        foreach ($hasil1 as $x) {
            $bobot[] = $x->jarak / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "jarak" => $jarak,
            "total" => $total,
            "bobot" => $bobot,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
    public function get_jumlah_responden_nilai_pendalaman($survei_id) {

        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, nilai_pendalaman FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);


        $pegawai_id = [];
        $nama_pegawai = [];
        $nilai_pendalaman = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $nilai_pendalaman[] = $x->nilai_pendalaman;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        $total = 0;
        foreach ($hasil1 as $x) {
            $total = $total + $x->nilai_pendalaman;
        }

        $bobot = [];
        foreach ($hasil1 as $x) {
            $bobot[] = $x->nilai_pendalaman / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "nilai_pendalaman" => $nilai_pendalaman,
            "total" => $total,
            "bobot" => $bobot,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
    public function get_jumlah_responden_produktivitas($survei_id) {
        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, produktivitas FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);
        $total = 0;

        $pegawai_id = [];
        $nama_pegawai = [];
        $skor = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $skor[] = $x->produktivitas;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        # menghitung range

        $temp = DB::select("SELECT MAX(produktivitas) as tertinggi, MIN(produktivitas) as terendah FROM `kuesioner_pegawai` WHERE survei_id= ?", [$survei_id]);
        $tertinggi = $temp[0]->tertinggi;
        $terendah = $temp[0]->terendah;
        unset($temp);

        $R = $tertinggi - $terendah;
//        unset($tertinggi);
//        unset($terendah);

        $N = sizeof($pegawai_id);
        $K = ceil(1 + 3.33 * log10($N));
        $I = ceil($R / $K);

//        echo "I: ".$I."<hr/>";
//        
//        foreach($hasil1 as $x){
//            print_r($x);
//            echo "<hr/>";
//        }

        $batas_bawah = range(1, $K);
        $batas_atas = range(1, $K);

        $batas_bawah[0] = $terendah;
        $batas_atas[0] = $batas_bawah[0] + $I - 1;

        for ($i = 1; $i < $K; $i++) {
            $batas_bawah[$i] = $batas_atas[$i - 1] + 1;
            $batas_atas[$i] = $batas_bawah[$i] + $I - 1;
        }

        $nilai_index = [];

        foreach ($skor as $x) {

            for ($i = 0; $i < $K; $i++) {
                if ($x >= $batas_bawah[$i] && $x <= $batas_atas[$i]) {
                    $nilai_index[] = $i + 1;
                    break;
                }
            }
        }

        $total = 0;
        foreach ($nilai_index as $x) {
            $total = $total + $x;
        }

        $bobot = [];
        foreach ($nilai_index as $x) {
            $bobot[] = $x / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "produktivitas" => $skor,
            "indeks" => $nilai_index,
            "bobot" => $bobot,
            "total" => $total,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
    public function get_jumlah_responden_umur($survei_id) {
        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, umur FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);
        $total = 0;

        $pegawai_id = [];
        $nama_pegawai = [];
        $skor = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $skor[] = $x->umur;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        # menghitung range

        $temp = DB::select("SELECT MAX(umur) as tertinggi, MIN(umur) as terendah FROM `kuesioner_pegawai` WHERE survei_id= ?", [$survei_id]);
        $tertinggi = $temp[0]->tertinggi;
        $terendah = $temp[0]->terendah;
        unset($temp);

        $R = $tertinggi - $terendah;
//        unset($tertinggi);
//        unset($terendah);

        $N = sizeof($pegawai_id);
        $K = ceil(1 + 3.33 * log10($N));
        $I = ceil($R / $K);

        //echo "N=".$N." - R=".$R." - K=".$K." - I=".$I."<hr>";
        
        
//        echo "I: ".$I."<hr/>";
//        
//        foreach($hasil1 as $x){
//            print_r($x);
//            echo "<hr/>";
//        }

        $batas_bawah = range(1, $K);
        $batas_atas = range(1, $K);

        $batas_bawah[0] = $terendah;
        $batas_atas[0] = $batas_bawah[0] + $I - 1;

        for ($i = 1; $i < 5; $i++) {
            $batas_bawah[$i] = $batas_atas[$i - 1] + 1;
            $batas_atas[$i] = $batas_bawah[$i] + $I - 1;
        }
        
        //print_r($batas_bawah);
        //print_r($batas_atas);

        $nilai_index = [];

        foreach ($skor as $x) {

            for ($i = 0; $i < $K; $i++) {
                if ($x >= $batas_bawah[$i] && $x <= $batas_atas[$i]) {
                    $nilai_index[] = $K - $i; // ingat, semakin tua indeks semakin kecil
                    break;
                }
            }
        }

        $total = 0;
        foreach ($nilai_index as $x) {
            $total = $total + $x;
        }

        $bobot = [];
        foreach ($nilai_index as $x) {
            $bobot[] = $x / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "umur" => $skor,
            "indeks" => $nilai_index,
            "bobot" => $bobot,
            "total" => $total,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
    public function get_jumlah_responden_kemampuan_komunikasi($survei_id) {
        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, kemampuan_komunikasi FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);
        $total = 0;

        $pegawai_id = [];
        $nama_pegawai = [];
        $skor = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $skor[] = $x->kemampuan_komunikasi;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        # menghitung range

        $temp = DB::select("SELECT MAX(kemampuan_komunikasi) as tertinggi, MIN(kemampuan_komunikasi) as terendah FROM `kuesioner_pegawai` WHERE survei_id= ?", [$survei_id]);
        $tertinggi = $temp[0]->tertinggi;
        $terendah = $temp[0]->terendah;
        unset($temp);

        $R = $tertinggi - $terendah;
//        unset($tertinggi);
//        unset($terendah);

        $N = sizeof($pegawai_id);
        $K = ceil(1 + 3.33 * log10($N));
        $I = ceil($R / $K);

//        echo "N=".$N." - R=".$R." - K=".$K." - I=".$I."<hr>";
        
        
//        echo "I: ".$I."<hr/>";
//        
//        foreach($hasil1 as $x){
//            print_r($x);
//            echo "<hr/>";
//        }

        $batas_bawah = range(1, $K);
        $batas_atas = range(1, $K);

        $batas_bawah[0] = $terendah;
        $batas_atas[0] = $batas_bawah[0] + $I - 1;

        for ($i = 1; $i < 5; $i++) {
            $batas_bawah[$i] = $batas_atas[$i - 1] + 1;
            $batas_atas[$i] = $batas_bawah[$i] + $I - 1;
        }
        
//        print_r($batas_bawah);
//        print_r($batas_atas);

        $nilai_index = [];

        foreach ($skor as $x) {

            for ($i = 0; $i < $K; $i++) {
                if ($x >= $batas_bawah[$i] && $x <= $batas_atas[$i]) {
                    $nilai_index[] = $i + 1; // ingat, semakin tua indeks semakin kecil
                    break;
                }
            }
        }

        $total = 0;
        foreach ($nilai_index as $x) {
            $total = $total + $x;
        }

        $bobot = [];
        foreach ($nilai_index as $x) {
            $bobot[] = $x / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "kemampuan_komunikasi" => $skor,
            "indeks" => $nilai_index,
            "bobot" => $bobot,
            "total" => $total,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
    public function get_jumlah_responden_ketebalan_dokumen($survei_id) {

        $ts = DB::select("SELECT nama_survei, jumlah_responden FROM survei where id = ?", [$survei_id]);
        $total_responden = $ts[0]->jumlah_responden;

        $hasil1 = DB::select("SELECT pegawai_id, survei_id, ketebalan_dokumen FROM `kuesioner_pegawai` WHERE survei_id = ?", [$survei_id]);


        $pegawai_id = [];
        $nama_pegawai = [];
        $ketebalan_dokumen = [];
        foreach ($hasil1 as $x) {
            $pegawai_id[] = $x->pegawai_id;
            $ketebalan_dokumen[] = $x->ketebalan_dokumen;
            $temp = DB::select("SELECT nama FROM pegawai where id = ?", [$x->pegawai_id]);
            $nama_pegawai[] = $temp[0]->nama;
        }

        $total = 0;
        foreach ($hasil1 as $x) {
            $total = $total + $x->ketebalan_dokumen;
        }

        $bobot = [];
        foreach ($hasil1 as $x) {
            $bobot[] = $x->ketebalan_dokumen / $total;
        }

        $jumlah_responden = [];
        foreach ($bobot as $bo) {
            $jumlah_responden[] = round($bo * $total_responden);
        }

        $data = array(
            "survei_id" => $survei_id,
            "nama_survei" => $ts[0]->nama_survei,
            "pegawai_id" => $pegawai_id,
            "nama_pegawai" => $nama_pegawai,
            "ketebalan_dokumen" => $ketebalan_dokumen,
            "total" => $total,
            "bobot" => $bobot,
            "jumlah_responden" => $jumlah_responden
        );

        return ($data);
    }
    
}
