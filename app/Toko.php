<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
//use App\Eloquent;



class Toko extends Eloquent
{
    protected $table = 'toko';

    public function edit($post, $target_file) {
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
        extract($post);
        $affected = DB::update('update toko set '
                        . 'id = ?,'
                        . 'nama_toko = ?, '
                        . 'no_hp = ?, '
                        . 'prov = ?, '
                        . 'kab = ?, '
                        . 'kec = ?, '
                        . 'alamat = ?, '
                        . 'tagline = ?, '
                        . 'fb = ?, '
                        . 'twitter = ?, '
                        . 'instagram = ?, '
                        . 'logo = ?, '
                        . 'cek_transfer = ?, '
                        . 'status = ?, '
                        . 'creator_id = ?, '
                        . 'updated_at = ? '
                        . 'where id = ?', [
                    $id,
                    $nama_toko,
                    $no_hp,
                    $prov,
                    $kab,
                    $kec,
                    $alamat_toko,
                    $tagline,
                    $facebook,
                    $twitter,
                    $instagram,
                    $target_file,
                    $cek_transfer,
                    $status,
                    $creator_id,
                    $update_skr,
                    $id
        ]);
        return ($affected);
    }

}
