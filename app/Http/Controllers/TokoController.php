<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Toko;
use App\Prov;
use App\Kab;
use App\Kec;
use Input;
use Session;

class TokoController extends Controller
{

	public $input;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        $halaman = "toko";
        $data = ['halaman' => $halaman];
        $prov = Prov::all();
        return view("toko/create", compact('prov'), $data);
    }

    public function show() {
        $halaman = "toko";
        $data = ['halaman' => $halaman];
        $toko_list = Toko::all();
        return view('toko/show', compact('toko_list'), $data);
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

    public function store(Request $request) {

    	$post = $request->request->all();

        $gambar = $request->file('foto');
        $gambar = $request->foto;

        $rules = array(
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('toko/create')
                            ->withErrors($validator);
        } else {

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

                	$tagline = Input::get('tagline');
                	$facebook = Input::get('facebook');
                	$twitter = Input::get('twitter');
                	$instagram = Input::get('instagram');

 	           		if($tagline == ''){
 		          		$tagline = NULL;
 		          	}

 	           		if($facebook == ''){
 		          		$facebook = NULL;
 		          	}

 	           		if($twitter == ''){
 		          		$twitter = NULL;
 		          	}

 	           		if($instagram == ''){
 		          		$instagram = NULL;
 		          	}

                    $toko = new Toko();
                    $toko->nama_toko = Input::get('nama_toko');
		            $toko->no_hp = Input::get('no_hp');
		            $toko->prov = Input::get('prov');
		            $toko->kab = Input::get('kab');
		            $toko->kec = Input::get('kec');
		            $toko->tagline = $tagline;
		            $toko->fb = $facebook;
		            $toko->twitter = $twitter;
		            $toko->instagram = $instagram;
		            $toko->cek_transfer = Input::get('cek_transfer');
		            $toko->status = Input::get('status');
		            $toko->logo = $target_file;
		            $toko->creator_id = Input::get('creator_id');
		            $toko->save();
                    return back()
                    ->with('success','Input Data Berhasil.');
                } else {
                    echo "eror";
                }
            }

            // jika ekstensi salah
            else {
                echo "pastikan format foto benar";
            }
        }
    	}

    }

    public function detail($id) {
        $halaman = "user";
        $data = ['halaman' => $halaman];
        $user = User::findOrFail($id);
        return view('user.detail', compact('user'), $data);
    }

    public function delete($id) {

        $user = User::findOrFail($id);
        $username = DB::select('SELECT username FROM users WHERE id='.$id);
        foreach ($username as $use) {
            DB::table('users')->where('username', '=', $use->username)->delete();
        }
        $user->delete();
        return redirect('user/show');
    }

    public function edit($id) {
        $halaman = "toko";
        $data = ['halaman' => $halaman];
        $toko = Toko::findOrFail($id);
        $prov = Prov::all();

        return view('toko/edit', compact('toko', 'prov'), $data);
    }

    public function update(Request $request) {
        $post = $request->request->all();

        $gambar = $request->file('foto');
        $gambar = $request->foto;

        $rules = array(
            'nama_toko' => 'required',
            'alamat_toko' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('toko/create')
                            ->withErrors($validator);
        } else {

        	// jika memang telah upload
        if (!is_null($gambar)) {
            //print_r('masuk sini');
            // jika ekstensi file benar
            if (in_array(strtolower($gambar->extension()), ['jpg', 'jpeg', 'png', 'gif'])) {
                $nama_acak = $this->generateRandomString();

                $target_file = $nama_acak . "." . $gambar->extension();

                $gambar->storeAs('images', $target_file);

                // jika berhasil upload
                print_r(url("storage/app/images/" . $target_file));

                if (file_exists(base_path("storage/app/images/" . $target_file))) {


                	$tagline = Input::get('tagline');
                	$facebook = Input::get('facebook');
                	$twitter = Input::get('twitter');
                	$instagram = Input::get('instagram');

 	           		if($tagline == ''){
 		          		$tagline = NULL;
 		          	}

 	           		if($facebook == ''){
 		          		$facebook = NULL;
 		          	}

 	           		if($twitter == ''){
 		          		$twitter = NULL;
 		          	}

 	           		if($instagram == ''){
 		          		$instagram = NULL;
 		          	}

                    $toko = new Toko();
		            $hasil = $toko->edit($post, $target_file);
                    return back()
                    ->with('success','Edit Data Berhasil.');
                } else {
                    echo "eror";
                }
            }

            // jika ekstensi salah
            else {
                echo "pastikan format foto benar";
            }
        }
    	}
		//return redirect('toko/show');
    }

	public function kab(){
        $id = $_GET['id'];
        $kabupaten = DB::select("SELECT * FROM masterkab WHERE kode_prov = $id ");

        echo '<select id="survei" class="form-control">
        <option value="-1" disabled>Pilih Kabupaten</option>';
                      
        foreach($kabupaten as $kab){
            echo "<option value='".$kab->id."'>".$kab->kabupaten."</option>";
        }

        echo '</select>';
    }

    public function kec(){
        $id = $_GET['id'];
        //echo 'id = '.$id; 
        $kecamatan = DB::select("SELECT * FROM masterkec WHERE kode_kab = $id ");

        echo '<select id="survei" class="form-control">
        <option value="-1" disabled>Pilih Survei</option>';
                      
        foreach($kecamatan as $kec){
            echo "<option value='".$kec->id."'>".$kec->kecamatan."</option>";
        }

        echo '</select>';
    }
}
