<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Target extends Eloquent
{
    protected $table = "target";
    public $timestamps = false;

    public function edit($nip, $survei_id, $realisasi){
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
        
        $affected = DB::update(
                        "UPDATE `target` SET  `realisasi`=?, `updated_at`=NOW() WHERE `nip` = ? AND `survei_id` = ? ", [
                    $realisasi, $nip, $survei_id
        ]);
    }

}
