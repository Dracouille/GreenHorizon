
<!DOCTYPE html>
<html lang="fr">

<body>

@include('layouts.head')
@extends('layouts.footer')
@include('layouts.NavBar')


<div class="container">

    <div class="row">
        <div class="box">


            {{--Liste des commentaires--}}
            <hr>
            <h2 class="intro-text text-center">
                Les commentaires
            </h2>
            <hr>

            @foreach($MesCom as $key => $value)
                <div class="row">
                    <div class="form-group col-sm-10" style="margin-left: 5%; margin-bottom: 40px">
                        <label for="titre" class="h3" style="font-weight: bold;">{{$value->Titre_com}}</label>
                        <br>
                        <label for="Contenu" class="h5">{{$value->Contenu_com}}</label>
                        <br>
                        <label for="auteur" class="h5" style="color: gainsboro">{{$value->Auteur_com}} publié le {{date('d/m/Y', strtotime($value->Date_com))}}</label>
                    </div>
                </div>
            @endforeach
            <br>




            {{--Poster un message--}}
            <hr>
            <h2 class="intro-text text-center">
                Donnez votre avis !
            </h2>
            <hr>
            <br>

            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name" class="h4">Qui êtes vous ?</label>
                    <input type="text" class="form-control" id="name" placeholder="Votre nom" required>
                </div>

                <div class="form-group col-sm-6">
                    <label for="email" class="h4">Résumer / Titre</label>
                    <input type="email" class="form-control" id="titre" placeholder="Titre" required>
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="h4 ">Avis</label>
                <textarea id="message" class="form-control" rows="5" placeholder="Votre avis" required></textarea>
            </div>

            <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Envoyer</button>
            <div id="msgSubmit" class="h3 text-center hidden">Envoyer !</div>
        </div>
    </div>

</div>

</body>

</html>
