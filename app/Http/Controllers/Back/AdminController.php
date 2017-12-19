<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	public function index()
    {
        return view('back.index');
    }

    public function GestionCom()
    {
        return view('back.commentaire');
    }
}
