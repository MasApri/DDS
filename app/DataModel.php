<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class DataModel extends Model
{
    protected $table = "siswa";
    
    public function edit($id, $nim, $nama, $ipk){
        DB::update('update siswa set nim = ?, nama = ?, ipk = ? where id = ?', [$nim, $nama, $ipk, $id]);
    }
    
    public function deleteSiswa($id){
        DB::delete('delete from siswa where id = ?',[$id]);
    }
    
}
