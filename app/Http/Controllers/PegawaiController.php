<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Pegawai;
use App\BuatPassword; 
use App\User;
use Input;
use Session;

class PegawaiController extends Controller {

    public $input;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create() {
        $halaman = "pegawai";
        $data = ['halaman' => $halaman];
        return view("pegawai/create", $data);
    }

    public function show() {
        $halaman = "pegawai";
        $data = ['halaman' => $halaman];
        $pegawai_list = DB::select('SELECT  pegawai.id, pegawai.nip, pegawai.ketepatan_waktu, pegawai.nama, pegawai.nilai_pengalaman,  tingkat_pendidikan.tingkat_pendidikan, jabatan.jabatan FROM `pegawai` ,`tingkat_pendidikan` ,`jabatan`  WHERE tingkat_pendidikan.id=pegawai.tingkat_pendidikan_id AND jabatan.id=pegawai.jabatan');
        return view('pegawai/show', compact('pegawai_list'), $data);
    }

    public function store(Request $request) {

        $rules = array(
            'nama' => 'required',
            'pendidikan' => 'required',
            'jabatan' => 'required',
            'nilai_pengalaman' => 'required|alpha_num',
        );

        $cek = 0;
        $jml_kasi = 0;
        $jabat = DB::select('SELECT jabatan FROM pegawai WHERE jabatan IN (1)');
        $kasi = DB::select('SELECT jabatan FROM pegawai WHERE jabatan = 2');

        foreach ($kasi as $kasi) {
            $jml_kasi = $jml_kasi + 1;
        }

        foreach ($jabat as $jabat ) {
            if($jabat->jabatan == 0){
                $cek = 0;
            }else{
                $cek = 1;
            }    
        }
        
        
        $validator = Validator::make(Input::all(), $rules);

        // process the input
        if ($validator->fails()) {
            return Redirect::to('pegawai/create')
                            ->withErrors($validator);
        } else {
            $genPass = new BuatPassword();
            $genPass = $genPass->randomPassword();
            $role = 3;
            
            if(Input::get('jabatan') == 1){
                $role = 2;
                if($cek == 1){
                    return Redirect::back()
                        ->withErrors('Jabatan Kepala BPS hanya boleh satu orang');
                }
            }elseif (Input::get('jabatan')== 2 ){
                $role = 2;
                if($jml_kasi > 6){
                    return Redirect::back()
                        ->withErrors('Jabatan KASI hanya boleh 6 orang');
                }
            }else{
                $role = 3;
            }

            $user = new User();
            $user->name = Input::get('nama');
            $user->email = Input::get('email');
            $user->nip = Input::get('nip');
            $user->username = Input::get('username');
            $user->password = bcrypt('123');
            $user->role = $role;
            $user->save();

            $pegawai = new Pegawai();
            $pegawai->nama = Input::get('nama');
            $pegawai->username = Input::get('username');
            $pegawai->nip = Input::get('nip');
            $pegawai->tingkat_pendidikan_id = Input::get('pendidikan');
            $pegawai->jabatan = Input::get('jabatan');
            $pegawai->nilai_pengalaman = Input::get('nilai_pengalaman');
            $pegawai->ketepatan_waktu = Input::get('ketepatan_waktu');
            $pegawai->email = Input::get('email');
            $pegawai->save();
            //$tes = $request->all();
            return back()
                    ->with('success','Input Data Berhasil.');
        }
    }

    public function detail($id) {
        $halaman = "pegawai";
        $data = ['halaman' => $halaman];
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.detail', compact('pegawai'), $data);
    }

    public function delete($id) {

        $pegawai = Pegawai::findOrFail($id);
        $username = DB::select('SELECT username FROM pegawai WHERE id='.$id);
        foreach ($username as $use) {
            DB::table('users')->where('username', '=', $use->username)->delete();
        }
        $pegawai->delete();
        return redirect('pegawai/show');
    }

    public function edit($id) {
        $halaman = "pegawai";
        $data = ['halaman' => $halaman];
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai/edit', compact('pegawai'), $data);
    }

    public function update(Request $request) {
        $post = $request->request->all();
        print_r($post);
        $model = new Pegawai();
        $users = new User(); 
        $hasil = $model->edit($post);
        $user_edit = $users->edit($post);

		return redirect('pegawai/show');
    }

}
