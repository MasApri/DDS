<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }

    public function edit($post) {
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
//        print_r($update_skr);
        extract($post);
        $affected = DB::update('update users set '
                        . 'name = ?, '
                        . 'username = ?, '
                        . 'email = ?, '
                        . 'updated_at = ? '
                        . 'where nip = ?', [
                    $nama,
                    $username,
                    $email,
                    $update_skr,
                    $nip
        ]);
        return ($affected);
    }

}
