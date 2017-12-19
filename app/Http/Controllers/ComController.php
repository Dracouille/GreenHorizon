<?php

namespace App\Http\Controllers;

//use Barryvdh\Debugbar\Middleware\Debugbar;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Http\Request;
use App\Com;
use App\Http\Requests;

class ComController extends Controller
{

    public function index()
    {
        $MesCom = Com::where("Valide_com","=", 1)
            ->orderBy('Date_Com','desc')->get();

        Debugbar::info($MesCom);

        return view('avis',['MesCom' => $MesCom]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
