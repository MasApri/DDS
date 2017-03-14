<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
//use App\Eloquent;

class Pegawai extends Eloquent {

    protected $table = 'pegawai';

    public function edit($post) {
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
//        print_r($update_skr);
        extract($post);
        $affected = DB::update('update pegawai set '
                        . 'id = ?,'
                        . 'nama = ?, '
                        . 'username = ?,'
                        . 'email = ?, '
                        . 'nip = ?, '
                        . 'ketepatan_waktu = ?, '
                        . 'tingkat_pendidikan_id = ?, '
                        . 'jabatan = ?, '
                        . 'nilai_pengalaman = ?, '
                        . 'updated_at = ? '
                        . 'where id = ?', [
                    $id,
                    $nama,
                    $username,
                    $email,
                    $nip,
                    $ketepatan_waktu,
                    $tingkat_pendidikan_id,
                    $jabatan,
                    $nilai_pengalaman,
                    $update_skr,
                    $id
        ]);
        return ($affected);
    }

}
