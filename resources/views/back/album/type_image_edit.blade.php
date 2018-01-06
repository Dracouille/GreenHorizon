@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Modifie le type de chantier')
@section('main')


    <script>
        function ConfirmDel()
        {
            var x = confirm("Valider la modification ?");
            if (x)
                return true;
            else
                return false;
        }
    </script>


    {{--Ouvre le fomulaire--}}
    {!! Form::open(array('route' => ['AdminUpdateTypeImage', $MonType->ID_type_image], 'files'=> true)) !!}
    {!! csrf_field() !!}

    <div class="row">
        <div class="col-sm-6 {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="h4">Titre</label>
            {!! Form::text('name', $MonType->Nom_type_image,['class'=>'form-control', 'required']) !!}
        </div>

        <br><br>

        <div class="col-sm-12 {{ $errors->has('img') ? ' has-error' : '' }}">
            <label for="img" class="h4">Vignette</label>
            <img src="{{asset($MonType->vignette_type_image)}}" alt="La vignette" style="width: 40%; height: 40%;" class="form-control">
        </div>

        <div class="col-sm-6">
            <input 	type='file' class='input-ghost' name='sujet' id="sujet" style='visibility:hidden; height:0' onchange="$(this).next().find('input').val(($(this).val()).split('\\').pop());">
            <div class="input-group input-file" name="sujet">
                <span class="input-group-btn">
                    <button class="btn btn-default btn-default" type="button" onclick="$(this).parents('.input-file').prev().click();">Choisir</button>
                </span>
                <input 	type="text" class="form-control" placeholder='Choisissez un fichier...' style="cursor:pointer" onclick="$(this).parents('.input-file').prev().click(); return false;"/>
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-reset" type="button" onclick="$(this).parents('.input-file').prev().val(null);$(this).parents('.input-file').find('input').val('');">Effacer</button>
                </span>
            </div>
        </div>
    </div>

    <br>

    {{--ferme le formulaire--}}
    {!! Form::submit('Envoyer', ['class' => 'btn btn-success btn-lg pull-left']) !!}
    <a href="{{ route('AdminIndexTypeImage') }}">
        {!! Form::button('Annuler', ['class' => 'btn btn-danger btn-lg pull-left']) !!}
    </a>
    {!! Form::close() !!}


@endsection