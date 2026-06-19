<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\SambutanKepalaSekolah;

use Illuminate\Http\Request;


class SambutanController extends Controller
{


public function index()
{

$this->authorize('cms.manage');


$data=SambutanKepalaSekolah::first();


return view(
'admin.sambutan.index',
compact('data')
);

}




public function update(Request $request)
{


$this->authorize('cms.manage');



$data=$request->validate([


'nama'=>'required',

'jabatan'=>'nullable',

'isi'=>'nullable',

'foto'=>'nullable|image'

]);



if($request->hasFile('foto'))
{

$data['foto']
=
$request->file('foto')
->store('sambutan','public');

}



SambutanKepalaSekolah::updateOrCreate(

['id'=>1],

$data

);



return back();


}


}