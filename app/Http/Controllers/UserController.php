<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\User;
use Input;
use Session;

class UserController extends Controller {

    public $input;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        $halaman = "user";
        $data = ['halaman' => $halaman];
        return view("user/create", $data);
    }

    public function show() {
        $halaman = "user";
        $data = ['halaman' => $halaman];
        $user_list = User::all();
        return view('user/show', compact('user_list'), $data);
    }

    public function store(Request $request) {

        $rules = array(
            'nama' => 'required',
            'username' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('user/create')
                            ->withErrors($validator);
        } else {
            
            $user = new User();
            $user->name = Input::get('nama');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->no_hp = Input::get('no_hp');
            $user->toko_id = Input::get('toko_id');
            $user->level_id = Input::get('level_id');
            $user->password = bcrypt('123');
            $user->creator_id = Input::get('creator_id');
            $user->save();

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
        $halaman = "user";
        $data = ['halaman' => $halaman];
        $user = User::findOrFail($id);
        return view('user/edit', compact('user'), $data);
    }

    public function update(Request $request) {
        $post = $request->request->all();
        print_r($post);
        $model = new User();
        $hasil = $model->edit($post);

		return redirect('user/show');
    }

}
