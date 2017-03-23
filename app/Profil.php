<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Profil extends Model {

    public function update_user($name, $username, $email, $password, $foto) {
        $email_lama = Auth::user()->email;
        $update1 = DB::update(
                        "UPDATE `users` SET `name`=?, `username`=?, `email`=?, `password`=?, `updated_at`=NOW(),`foto`=? WHERE id = ?", [
                    $name, $username, $email, bcrypt($password), $foto, Auth::user()->id
        ]);
        $update1 = DB::update(
                        "UPDATE `pegawai` SET `nama`=?, `username`=?, `email`=?, `updated_at`=NOW() WHERE email = ?", [
                    $name, $username, $email, $email_lama
        ]);
    }

}
