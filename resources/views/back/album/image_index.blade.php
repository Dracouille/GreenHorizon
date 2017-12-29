@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Gestion des photos')
@section('main')


    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-inverse">
        <tr>
            <th class="col-md-2">Nb photos</th>
            <th>Nom du groupe</th>
            <th class="col-md-1">Importer photos</th>
            <th class="col-md-1">Gérer photos</th>
        </tr>
        </thead>
        <tbody>

        @foreach($MesType as $key => $value)
            <tr>
                <td>{{ $NbPhotos[$value->ID_type_image]}}</td>
                <td>{{$value->Nom_type_image}}</td>
                <td>
                    <a href="{{ route('AdminCreateImage', ['id' => $value->ID_type_image]) }}">
                        <button class="btn btn-default btn-sm">
                            <img src="{{asset('img/icon/import-m.png')}}"/>
                        </button>
                    </a>
                </td>
                <td>
                    <a href="{{ route('AdminGestionImageType', ['id' => $value->ID_type_image]) }}">
                        <button class="btn btn-default btn-sm">
                            <img src="{{asset('img/icon/update-m.png')}}"/>
                        </button>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


@endsection