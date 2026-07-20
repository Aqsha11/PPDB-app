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



public function create()
{
    $this->authorize("cms.manage");

    return view("admin.statistik.create");
}



public function show(StatistikSekolah $statistik)
{
    $this->authorize("cms.manage");

    $data = $statistik;

    return view("admin.statistik.show", compact("data"));
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


return redirect()->route('admin.statistik.index')->with('success', 'Statistik berhasil dibuat.');

}


public function edit(StatistikSekolah $statistik)
{
    $this->authorize('cms.manage');

    $data = $statistik;

    return view('admin.statistik.edit', compact('data'));
}


public function update(Request $request, StatistikSekolah $statistik)
{
    $this->authorize('cms.manage');

    $statistik->update(

        $request->validate([

            'judul' => 'required',

            'jumlah' => 'required',

            'icon' => 'nullable'

        ])

    );

    return redirect()->route('admin.statistik.index')->with('success', 'Statistik berhasil diperbarui.');
}

public function destroy(StatistikSekolah $statistik)
{


$this->authorize('cms.manage');


$statistik->delete();


return redirect()->route('admin.statistik.index')->with('success', 'Statistik berhasil dihapus.');


}


public function toggleStatus(StatistikSekolah $statistik)
{
    $this->authorize('cms.manage');

    $statistik->update(['is_aktif' => !$statistik->is_aktif]);

    return back()->with('success', 'Status berhasil diubah.');
}


}
