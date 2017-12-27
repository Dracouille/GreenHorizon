@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Liste des types de chantiers')
@section('main')

    <script>
        function ConfirmDel()
        {
            var x = confirm("Supprimer le groupe ?");
            if (x)
                return true;
            else
                return false;
        }
    </script>


    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif


    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-inverse">
        <tr>
            <th class="col-md-2">Nb photos</th>
            <th>Nom du groupe</th>
            <th class="col-md-1">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($MesType as $key => $value)
            <tr>
                <td>{{ $NbPhotos[$value->ID_type_image]}}</td>
                <td>{{$value->Nom_type_image}}</td>
                <td>
                    <center>
                        <a onclick="return ConfirmDel()" href="{{ route('AdminDeleteTypeImage', ['id' => $value->ID_type_image]) }}">
                            <button class="btn btn-danger btn-sm">X</button>
                        </a>
                        <a href="{{ route('AdminEditTypeImage', ['id' => $value->ID_type_image]) }}">
                            <button class="btn btn-default btn-sm">
                                <img src="{{asset('img/update.png')}}"/>
                            </button>
                        </a>
                    </center>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    <br><br><br>


    {{--Ajout d'un groupe--}}

    {{--Ouvre le fomulaire--}}
    {!! Form::open(array('route' => 'AdminStoreTypeImage')) !!}
    {!! csrf_field() !!}

    <div class="row">
        <div class="form-group col-sm-6 {{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="h4">Ajouter un nouveau type...</label>
            {!! Form::text('name', Input::old('name'),['class'=>'form-control', 'placeholder'=>'Nom', 'required']) !!}
        </div>
    </div>

    {{--ferme le formulaire--}}
    {!! Form::submit('Envoyer', ['class' => 'btn btn-success btn-lg pull-left']) !!}
    {!! Form::close() !!}


@endsection