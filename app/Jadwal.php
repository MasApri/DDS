<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

//use App\Eloquent;

class Jadwal extends Eloquent {

    public function cek_kelengkapan_dokumen() {
        $temp1 = DB::select("select id, nama_survei from survei");
        $data = [];

        foreach ($temp1 as $x) {
            $temp2 = DB::select("select id, nama from pegawai where id not in (select pegawai_id from kuesioner_pegawai where survei_id = $x->id)");
            $temp3 = [];
            if (!empty($temp2)) {
                foreach ($temp2 as $y) {
                    $temp3[] = array("id_survei" => $x->id,
                        "nama_survei" => $x->nama_survei,
                        "id_pegawai" => $y->id,
                        "nama_pegawai" => $y->nama
                    );
                }
//                print_r($temp3);
//                echo "<hr/>";
                $data[] = $temp3;
            }
        }
//        foreach($data as $x){
//            print_r($x);
//            echo "<hr>";
//        }
        return $data;
    }

    public function list_pegawai_yang_belum_isi_survei($survei_id) {
        $hasil = DB::select('SELECT * FROM `pegawai` WHERE id not in (select pegawai_id from kuesioner_pegawai where survei_id=?)', [$survei_id]);
        return ($hasil);
    }

    public function simpan_banyak_kuesioner_pegawai($formulir) {
        foreach ($formulir as $x) {
            $deleted = DB::delete('delete from kuesioner_pegawai where pegawai_id = ? and survei_id = ?', [$x['pegawai_id'], $x['survei_id']]);
            DB::insert('insert into kuesioner_pegawai ('
                    . '`pegawai_id`, `survei_id`, `jabatan_fungsional`, `keterlibatan_survei`, `jarak`, `nilai_pendalaman`, `produktivitas`, `umur`, `kemampuan_komunikasi`, `ketebalan_dokumen`'
                    . ') values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $x['pegawai_id'], $x['survei_id'], $x['jabatan_fungsional'], $x['keterlibatan_survei'], $x['jarak'], $x['nilai_pendalaman'], $x['produktivitas'], $x['umur'], $x['kemampuan_komunikasi'], $x['ketebalan_dokumen']
            ]);
        }
    }

    public function nama_survei($survei_id) {
        $hasil = DB:: select('select nama_survei from survei where id = ?', [$survei_id]);
        return ($hasil[0]->nama_survei);
    }

}
