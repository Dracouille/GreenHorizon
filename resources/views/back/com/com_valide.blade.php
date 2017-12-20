@extends('back.layout')
@section('title', 'Gestion des commentaires')
@section('desc', 'test')
@section('main')

    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-inverse">
        <tr>
            <th>Par</th>
            <th>Titre</th>
            <th>Message</th>
            <th>Valide</th>
        </tr>
        </thead>
        <tbody>

        @foreach($NonLu as $key => $value)
            <tr>
                <td>{{$value->Auteur_com}}</td>
                <td>{{$value->Titre_com}}</td>
                <td>{{$value->Contenu_com}}</td>
                <td>
                    <button class="btn btn-success btn-sm" href="">V</button>
                    <button class="btn btn-danger btn-sm" href="">X</button>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection