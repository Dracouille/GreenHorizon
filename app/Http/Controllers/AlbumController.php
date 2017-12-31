<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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

    public function store(Request $request, $id)
    {

        $Type = Type_Image::find($id);
        $ordreimage = $this->ChercheDernier($id);
        $path = public_path() . '/img/photos/' . $Type->ID_type_image;
        $pathcourt = '/img/photos/' . $Type->ID_type_image;

        $files = $request->file('filesToUpload');
        if($request->hasFile('filesToUpload'))
        {
            if(!File::exists($path)) {
                File::makeDirectory($path);
            }

            foreach ($files as $file) {
                //Store file
                $fileName = $file->getClientOriginalName();
                $storeName = Carbon::now()->format('h-i-s') . '_' . $fileName;
                $file->move($path, $storeName);

                //Store in Dbb
                $image = new Album();
                $ordreimage++;
                $image->lien_image = $pathcourt . '/' . $storeName;
                $image->ID_type_image = $id;
                $image->ordre_image= $ordreimage;
                $image->save();
            }
        }
        return redirect()->route('AdminIndexImage');
    }

    public function show($id)
    {
        //
    }

    public function delete($id)
    {
        $image = Album::find($id);

        if (!$image == null) {
            if (File::exists(public_path() . $image->lien_image)){
                File::delete(public_path() . $image->lien_image);
                $image->delete();
            }
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

        return view('back.album.image_gestion_type', compact('notif', 'ListeImage', 'id'));
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

    public function ChercheDernier($id){ //ID des type
        $image = Album::where("ID_type_image","=", $id)->max('ordre_image');;

        return $image;
    }

    public function VideTout($id){ //ID des type
        $album = Album::where("ID_type_image","=", $id)->get();

        foreach ($album as $photo) {
            if (File::exists(public_path() . $photo->lien_image)){
                File::delete(public_path() . $photo->lien_image);
                $photo->delete();
            }
        }
        return redirect()->route('AdminIndexImage');
    }

}
