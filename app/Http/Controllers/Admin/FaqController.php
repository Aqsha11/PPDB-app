<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

use App\Models\Faq;

use Illuminate\Http\Request;



class FaqController extends Controller
{


    public function index()
    {

        $data = Faq::orderBy('urutan')
            ->get();


        return view(
            'admin.faq.index',
            compact('data')
        );
    }





    public function store(Request $request)
    {


        Faq::create(

            $request->validate([

                'pertanyaan' => 'required',

                'jawaban' => 'required',

                'urutan' => 'nullable'

            ])

        );


        return back();
    }




    public function update(Request $request, Faq $faq)
    {


        $faq->update(

            $request->validate([

                'pertanyaan' => 'required',

                'jawaban' => 'required'

            ])

        );


        return back();
    }





    public function destroy(Faq $faq)
    {

        $faq->delete();


        return back();
    }
}
