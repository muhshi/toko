<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Lisensi;
use Input;
use Session;

class LisensiController extends Controller
{
    public $input;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        $halaman = "lisensi";
        $data = ['halaman' => $halaman];
        return view("lisensi/create", $data);
    }

    public function show() {
        $halaman = "lisensi";
        $data = ['halaman' => $halaman];
        $lisensi_list = Lisensi::all();
        return view('lisensi/show', compact('lisensi_list'), $data);
    }

    public function store(Request $request) {

        $rules = array(
            'jumlah' => 'required',
            'keterangan' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('lisensi/create')
                            ->withErrors($validator);
        } else {
            $toko_id = Input::get('toko_id');
            if($toko_id == ''){
            	$toko_id = NULL;
            }

            $lisensi = new Lisensi();
            $lisensi->user_id = Input::get('user_id');
            $lisensi->jumlah = Input::get('jumlah');
            $lisensi->keterangan = Input::get('keterangan');
            $lisensi->tanggal = Input::get('tanggal');
            $lisensi->toko_id = $toko_id;
            $lisensi->save();

            return back()
                    ->with('success','Input Data Berhasil.');
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
        $halaman = "lisensi";
        $data = ['halaman' => $halaman];
        $lisensi = Lisensi::findOrFail($id);
        return view('lisensi/edit', compact('lisensi'), $data);
    }

    public function update(Request $request) {
        $post = $request->request->all();
        print_r($post);
        $model = new Lisensi();
        $hasil = $model->edit($post);

		return redirect('lisensi/show');
    }


}
