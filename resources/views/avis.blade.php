
<!DOCTYPE html>
<html lang="fr">

<body>

@include('layouts.head')
@extends('layouts.footer')
@include('layouts.NavBar')


<div class="container">

    <div class="row">
        <div class="box">


            {{--Message de confirm--}}
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif



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

            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            {{--Ouvre le fomulaire--}}
            {!! Form::open(array('url' => '/avis')) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="form-group col-sm-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="h4">Qui êtes vous ?</label>
                    {!! Form::text('name', Input::old('name'),['class'=>'form-control']) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-sm-6 {{ $errors->has('resume') ? ' has-error' : '' }}">
                    <label for="resume" class="h4">Résumer / Titre</label>
                    {!! Form::text('resume', Input::old('resume'),['class'=>'form-control']) !!}
                    @if ($errors->has('resume'))
                        <span class="help-block">
                            <strong>{{ $errors->first('resume') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                <label for="message" class="h4 ">Avis</label>
                {!! Form::textarea('message', Input::old('message'),['class'=>'form-control', 'rows' => '5']) !!}
                @if ($errors->has('message'))
                    <span class="help-block">
                        <strong>{{ $errors->first('message') }}</strong>
                    </span>
                @endif
            </div>

            {{--ferme le formulaire--}}
            {!! Form::submit('Envoyer', ['class' => 'btn btn-success btn-lg pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>

</div>

</body>

</html>
