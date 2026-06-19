<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\StatistikSekolah;

use Illuminate\Http\Request;


class StatistikController extends Controller
{


public function index()
{


$this->authorize('cms.manage');


$data=StatistikSekolah::all();


return view(
'admin.statistik.index',
compact('data')
);


}




public function store(Request $request)
{


$this->authorize('cms.manage');



StatistikSekolah::create(

$request->validate([


'judul'=>'required',

'jumlah'=>'required',

'icon'=>'nullable'


])

);



return back();

}




public function destroy(StatistikSekolah $statistik)
{


$this->authorize('cms.manage');


$statistik->delete();


return back();

}


}