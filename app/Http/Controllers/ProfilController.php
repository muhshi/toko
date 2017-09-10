<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests; 
use Input;
use Validator;
use Redirect;
use Session;
use App\Profil;
use App\Target;
use App\Seksi;
use App\Survei;

class ProfilController extends Controller {
 
    public function index(){
        $halaman = "profil";
        $data = ['halaman' => $halaman];
        return view('profil.profil', $data);
    }

    public function edit(Request $request) {
        $halaman = "profil";
        $data = ['halaman' => $halaman];
        $model = new Profil();
        return view('profil.edit', $data);
    }

    public function realisasi(){
        $halaman = "profil";
        $data = ['halaman' => $halaman];
        $model = new Profil();
        return view('profil.edit', $data);
    }

    public function ajax() {
        $id = $_GET['id'];
        $survei = DB::select("SELECT * FROM survei WHERE seksi_id = $id ");

        echo '<select id="survei" class="form-control" name="survei">
        <option value="-1" disabled>Pilih Survei</option>';
                      
        foreach($survei as $sur){
            echo "<option value='".$sur->id."'>".$sur->nama_survei."</option>";
        }

        echo '</select>';
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function upload(Request $request) {

        $post = $request->request->all();

        $gambar = $request->file('foto');
        $gambar = $request->foto;

        // jika memang telah upload
        if (!is_null($gambar)) {

            // jika ekstensi file benar
            if (in_array(strtolower($gambar->extension()), ['jpg', 'jpeg', 'png', 'gif'])) {
                $nama_acak = $this->generateRandomString();

                $target_file = $nama_acak . "." . $gambar->extension();

                $gambar->storeAs('images', $target_file);

                // jika berhasil upload
                print_r(url("storage/app/images/" . $target_file));

                if (file_exists(base_path("storage/app/images/" . $target_file))) {
                    $model = new Profil();
                    $model->update_user($post['name'], $post['username'], $post['email'], $post['password'], $target_file);
                } else {
                    echo "eror";
                }
            }

            // jika ekstensi salah
            else {
                echo "pastikan format foto benar";
            }
        }

        // jika update tanpa upload
        else {

            $model = new Profil();
            $model->update_user($post['name'], $post['username'], $post['email'], $post['password'], Auth::user()->foto);
        }

        return redirect('profil/edit');
    }

}
