<?php

namespace App\Http\Controllers\Back;

use App\Com;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facade as Debugbar;

class AdminController extends Controller
{
	public function index()
    {
        $notif = $this->Notif();

//        return view('back.index');
        return view('back.index', compact('notif'));

    }

    public function ComAValider()
    {
        $notif = $this->Notif();

        $NonLu = Com::where("Valide_com","=", 0)->get();

        return view('back.com.com_valide', compact('notif', 'NonLu'));
    }

    public function ValideCom()
    {

    }


    public function Notif()
    {
        $NbCom = Com::where("Valide_com","=", 0)->count();

        return $NbCom;
    }


}
