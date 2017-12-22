@extends('back.layout')
@section('title', 'Gestion des commentaires')
@section('desc', 'Liste des commentaires')
@section('main')

    <script>
        function ConfirmBack()
        {
            var x = confirm("Supprimer le commentaire ?");
            if (x)
                return true;
            else
                return false;
        }
    </script>


    <table class="table table-hover table-striped table-bordered">
        <thead class="thead-inverse">
        <tr>
            <th>Par</th>
            <th>Date</th>
            <th>Titre</th>
            <th>Message</th>
            <th>Supprime</th>
        </tr>
        </thead>
        <tbody>

        @foreach($Com as $key => $value)
            <tr>
                <td>{{$value->Auteur_com}}</td>
                <td>{{$value->Date_com}}</td>
                <td>{{$value->Titre_com}}</td>
                <td>{{$value->Contenu_com}}</td>
                <td>
                    <center>
                        <a onclick="return ConfirmBack()" href="{{ route('DeleteCom', ['id' => $value->ID_com]) }}">
                            <button class="btn btn-danger btn-sm">X</button>
                        </a>
                    </center>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{--Pagination--}}
    <br>
    <center style="margin-top: -3%">
        {{$Com->links() }}
    </center>


@endsection