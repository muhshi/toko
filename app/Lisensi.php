<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;

class Lisensi extends Eloquent
{
    protected $table = 'lisensi';

	public function edit($post) {
        date_default_timezone_set('Asia/Jakarta');
        $update_skr = date('Y-m-d H:i:s');
        extract($post);
        $affected = DB::update('update lisensi set '
                        . 'id = ?,'
                        . 'user_id = ?, '
                        . 'jumlah = ?, '
                        . 'tanggal = ?, '
                        . 'keterangan = ?, '
                        . 'toko_id = ?, '
                        . 'updated_at = ? '
                        . 'where id = ?', [
                    $id,
                    $user_id,
                    $jumlah,
                    $tanggal,
                    $keterangan,
                    $toko_id,
                    $update_skr,
                    $id
        ]);
        return ($affected);
    }

}
