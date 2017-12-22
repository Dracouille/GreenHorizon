<?php

namespace App\Http\Controllers;

//use Barryvdh\Debugbar\Middleware\Debugbar;
use Barryvdh\Debugbar\Facade as Debugbar;
use Toast;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Com;

use App\Http\Requests;
use Carbon\Carbon;

class ComController extends Controller
{

    private function getRules(){
        $Rules = ['name' => 'required|max:255',
            'resume' => 'required|max:255',
            'message' => 'required'];
        return $Rules;
    }

    private function getMessages(){
        $messages = [
            'name.required' => 'Veuillez saisir un nom',
            'name.max' => 'Nom trop long, max. 255',
            'resume.required' => 'Veuillez saisir un titre',
            'resume.max' => 'Titre trop long, max. 255',
            'message.required' => 'Veuillez saisir un message'
        ];
        return $messages;
    }

    public function index()
    {
        $MesCom = Com::where("Valide_com","=", 1)
            ->orderBy('Date_Com','desc')
            ->paginate(5);

        return view('avis',['MesCom' => $MesCom]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $Inputs = Input::all();

        $validator = Validator::make($Inputs, $this->getRules(),$this->getMessages());

        if ($validator->fails()){
            return Redirect::to('/avis')->withErrors($validator)->withInput(Input::except('password'));
        } else {

            // store
            $com = new Com;
            $com->Date_com      = Carbon::now();
            $com->Titre_com     = Input::get('resume');
            $com->Contenu_com   = Input::get('message');
            $com->Auteur_com    = Input::get('name');
            $com->Valide_com    = 0;
            $com->save();

            Toast::success('Merci pour votre avis', 'Merci');

            return Redirect::to('/avis');
        }
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

    public function ValideCom($id)
    {
        $com = Com::find($id);
        if (!$com == null) {
            $com->Valide_com = 1;
            $com->save();
        }

        return redirect()->route('ComAValider');
    }

    public function delete($id)
    {
        $com = Com::find($id);
        if (!$com == null) {
            $com->delete();
        }

//        return redirect()->route('ComAValider');
        return redirect::back();
    }

}
