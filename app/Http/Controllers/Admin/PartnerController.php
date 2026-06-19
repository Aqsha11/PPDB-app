<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Partner;

use Illuminate\Http\Request;



class PartnerController extends Controller
{


    public function index()
    {

        $data = Partner::all();


        return view(
            'admin.partner.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        $data = $request->validate([

            'nama' => 'required',

            'logo' => 'required|image',

            'website' => 'nullable'

        ]);



        $data['logo']
            =
            $request->file('logo')
            ->store(
                'partner',
                'public'
            );



        Partner::create($data);



        return back();
    }





    public function destroy(Partner $partner)
    {

        $partner->delete();


        return back();
    }
}
