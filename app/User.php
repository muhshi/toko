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
        extract($post);
        $affected = DB::update('update users set '
                        . 'id = ?,'
                        . 'name = ?, '
                        . 'username = ?, '
                        . 'no_hp = ?, '
                        . 'email = ?, '
                        . 'toko_id = ?, '
                        . 'level_id = ?, '
                        . 'creator_id = ?, '
                        . 'updated_at = ? '
                        . 'where id = ?', [
                    $id,
                    $name,
                    $username,
                    $no_hp,
                    $email,
                    $toko_id,
                    $level_id,
                    $creator_id,
                    $update_skr,
                    $id
        ]);
        return ($affected);
    }

}
