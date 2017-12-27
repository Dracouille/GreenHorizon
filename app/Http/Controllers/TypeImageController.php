<?php

namespace App\Http\Controllers;

use App\Album;
use App\Com;
use App\Type_Image;
use DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;

class TypeImageController extends Controller
{

    public function index()
    {
        $NbPhotos = [];

        //Compte les notif
        $notif = $this->Notif();

        //Types
        $MesType = Type_Image::all();

        //compte les photos
        foreach ($MesType as $cle => $valeur) {
            $NbPhotos[$valeur -> ID_type_image ] = Album::where("ID_type_image","=", $valeur -> ID_type_image)->count();
        }

        return view('back.album.type_image_index', compact('notif', 'MesType', 'NbPhotos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $Type = new Type_Image;
        $Type->Nom_type_image = Input::get('name');
        $Type->save();

        return redirect()->route('AdminIndexTypeImage');
    }

    public function show($id)
    {
        //
    }

    public function delete($id)
    {
        $type = Type_Image::find($id);
        $NbImage = Album::where("ID_type_image","=", $type->ID_type_image)->count();

        if ((!$type == null) and ($NbImage == 0)) {
            $type->delete();
        }else{
            Session::flash('message', "Impossible de supprimer, il y a des photos dans ce groupe");
        }

        return redirect::back();
    }

    public function edit($id)
    {
        //Compte les notif
        $notif = $this->Notif();

        $MonType = Type_Image::find($id);

        return view('back.album.type_image_edit', compact('notif', 'MonType'));
    }

    public function update(Request $request, $id)
    {
        //Compte les notif
        $notif = $this->Notif();

        $MonType = Type_Image::find($id);

        if (!$MonType == null){
            $MonType->Nom_type_image = Input::get('name');
            $MonType->save();
        }
        return redirect()->route('AdminIndexTypeImage');
    }

    public function Notif()
    {
        $NbCom = Com::where("Valide_com","=", 0)->count();

        return $NbCom;
    }
}