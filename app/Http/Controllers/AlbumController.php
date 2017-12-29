<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Album;
use App\Com;
use App\Type_Image;
use DebugBar;

use App\Http\Requests;

class AlbumController extends Controller
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

        return view('back.album.image_index', compact('notif', 'MesType', 'NbPhotos'));
    }

    public function create($id)
    {
        //Compte les notif
        $notif = $this->Notif();

        $MonType = Type_Image::find($id);

        return view('back.album.image_import', compact('notif', 'MonType'));
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
        $image = Album::find($id);

        if (!$image == null) {
            $image->delete();
        }else{
            Session::flash('message', "Impossible de supprimer");
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

    public function GestionPhotoGroupe($id)
    {
        //Compte les notif
        $notif = $this->Notif();

        $ListeImage = Album::where("ID_type_image","=", $id)
            ->orderby('ordre_image')
            ->get();

        return view('back.album.image_gestion_type', compact('notif', 'ListeImage'));
    }

    public function Ordre($liste)
    {
        $ordre = 1;

        //Sépare la chaine avec le &
        $item = explode("&", $liste);

        //boucle sur le tableau
        foreach ($item as $val => $valeur) {
            //select l'id
            $ID = explode("=", $valeur);

            //save
            $MonImage = Album::find($ID[1]);
            $MonImage->ordre_image = $ordre;
            $MonImage->save();
            $ordre++;
        }

        return redirect::back();
    }
}
