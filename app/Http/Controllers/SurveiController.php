<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Survei;
use App\Target;
use Input;
use Session;

class SurveiController extends Controller
{
    public $input;

    public function __construct(){
        
        $this->middleware('auth');
    }

    public function create(){
    	$halaman = "survei";
        $data = ['halaman' => $halaman];
        return view("survei/create", $data);
    }

    public function show(){
    	$halaman = "survei";
        $data = ['halaman' => $halaman];
    	$survei_list = DB::select('SELECT survei.id, survei.nama_survei, pendekatan_unit_sampel.pendekatan_unit_sampel, indeks_kesulitan.indeks_kesulitan, seksi.seksi 
            FROM  survei, pendekatan_unit_sampel, indeks_kesulitan, seksi WHERE pendekatan_unit_sampel.id=survei.pendekatan_unit_sampel AND seksi.id = survei.seksi_id  AND indeks_kesulitan.id=survei.indeks_kesulitan_id');
    	return view('survei/show', compact('survei_list'), $data);
    }

    public function store(Request $request){

    $rules = array(
	   'nama_survei'  		           	=> 'required',
	   'pendekatan_unit_sampel'   		=> 'required',
	  );
	  $validator = Validator::make(Input::all(), $rules);

	  // process the login
	  if ($validator->fails()) {
	   return Redirect::to('survei/create')
	    ->withErrors($validator)
	    ->withInput(Input::except('indeks_kesulitan_id'));
	  } else {

        //$column = Input::get('nama_survei');
        //$text = str_replace(' ', '', $column);
        //$text = str_replace('/', '', $text);
        //$text = str_replace('(', '', $text);
        //$text = str_replace(')', '', $text);

    	$survei             			= new Survei();
        $survei->seksi_id               = Input::get('seksi_id');
		$survei->nama_survei  			= Input::get('nama_survei');
		$survei->pendekatan_unit_sampel 		= Input::get('pendekatan_unit_sampel');
		$survei->indeks_kesulitan_id 	= Input::get('indeks_kesulitan_id');
		$survei->save();
    	//$tes = $request->all();
        //$target         = new Target();
        //DB::statement('ALTER TABLE target ADD COLUMN '.$text.' INT');
        //DB::statement('ALTER TABLE produktifitas ADD COLUMN '.$text.' INT');

    	return back()
                    ->with('success','Input Data Berhasil.');
    }
    }

    public function detail($id){
    	$halaman = "survei";
        $data = ['halaman' => $halaman];
    	$survei = Survei::findOrFail($id);
    	return view('survei.detail', compact('survei'), $data);
    }

    public function delete($id){

    	$survei = Survei::findOrFail($id);
    	$survei->delete();
    	return redirect('survei/show');
    }
    
    public function edit($id){
        $survei = Survei::findOrFail($id);
    	return view('survei/edit', ['survei' => $survei]);
    }
    
    public function update(Request $request){
        $post = $request->request->all();
        print_r($post);
        $model = new Survei();
        $hasil = $model->edit($post);
        
        return redirect('survei/show');
        
        
    }
    
    
}
