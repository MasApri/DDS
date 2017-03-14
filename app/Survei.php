<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Survei extends Eloquent
{
    protected $table = 'survei';
    
    public function edit($post){
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
//        print_r($update_skr);
        extract($post);
        $affected = DB::update('update survei set '
                . 'id = ?,'
                . 'seksi_id = ?,'
                . 'nama_survei = ?, '
                . 'pendekatan_unit_sampel = ?, '
                . 'indeks_kesulitan_id = ?, '
                . 'updated_at = ? '
                . 'where id = ?', 
                [
                    $id, 
                    $seksi_id,
                    $nama_survei, 
                    $pendekatan_unit_sampel,
                    $indeks_kesulitan_id,
                    $update_skr,
                    $id                   
                    ]);
        return ($affected);
    }
    
}
