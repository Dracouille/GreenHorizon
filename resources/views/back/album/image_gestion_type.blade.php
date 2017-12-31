@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Gestion des images par type')
@section('main')

    <head>
        <style>
            #sortable { list-style-type: none; margin: 0; padding: 0; }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
            } );
        </script>
    </head>

    <br>

    @if (!$ListeImage -> isEmpty())
        <center>
            <a class="save">
                {!! Form::button('Enregistrer les positions', ['class' => 'col-lg-10 btn save btn-success']) !!}
            </a>
            <a class="supp" onclick="return ConfirmVide()" href="{{ route('AdminDeleteToutImage', ['id' => $id]) }}">
                {!! Form::button('Vider', ['class' => ' col-lg-2 btn btn-danger pull-right']) !!}
            </a>
        </center>
    @endif

    <br><br>

    <ul id="sortable" class ="sortable">
        @foreach($ListeImage as $key => $value)
            <div id='item-{{$value->ID_image}}' class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe" style="margin-bottom: 20px; cursor: move">
                <img src="{{asset( $value->lien_image )}}" alt="picture" class="img-responsive img-thumbnail"/>
                <center>
                    <a onclick="return ConfirmDel()" href="{{ route('AdminDeleteImage', ['id' => $value->ID_image]) }}">
                        {{ Form::button('Supprime', array('class' => 'btn btn-danger')) }}
                    </a>
                </center>
            </div>
        @endforeach
    </ul>

    <script type="text/javascript">
        var ul_sortable = $('.sortable'); //setup one variable for sortable holder that will be used in few places


        /*
        * jQuery UI Sortable setup
        */

        ul_sortable.sortable({
            revert: 100,
            placeholder: 'placeholder'
        });
        ul_sortable.disableSelection();



        /*
        * Saving and displaying serialized data
        */
        var btn_save = $('button.save'), // select save button
            div_response = $('#response'); // response div



        btn_save.on('click', function(e){ // trigger function on save button click
            e.preventDefault();

            // var sortable_data = ul_sortable.sortable('serialize'); // serialize data from ul#sortable
            var sortable_data = ul_sortable.sortable('serialize'); // serialize data from ul#sortable

            var url = '{{ route("AdminOrdreImage", ":var") }}';
            url = url.replace(':var', sortable_data);
            window.location.href=url;

        });

        function ConfirmDel()
        {
            var x = confirm("Valider la suppression ?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmVide()
        {
            var x = confirm("Vider le type ?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection