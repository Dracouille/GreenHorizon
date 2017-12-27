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
    {!! Form::open(array('route' => ['AdminUpdateTypeImage', $MonType->ID_type_image])) !!}
    {!! csrf_field() !!}

    <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="h4">Modifier</label>
            {!! Form::text('name', $MonType->Nom_type_image,['class'=>'form-control', 'required']) !!}
        </div>
    </div>

    {{--ferme le formulaire--}}
    {!! Form::submit('Envoyer', ['class' => 'btn btn-success btn-lg pull-left']) !!}
    <a href="{{ route('AdminIndexTypeImage') }}">
        {!! Form::button('Annuler', ['class' => 'btn btn-danger btn-lg pull-left']) !!}
    </a>
    {!! Form::close() !!}


@endsection