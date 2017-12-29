@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Gestion des images par type')
@section('main')

    <script>
        function ConfirmDel()
        {
            var x = confirm("Valider la suppression ?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    @foreach($ListeImage as $key => $value)
        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe" style="margin-bottom: 20px">
            <img src="{{asset( $value->lien_image )}}" alt="picture" class="img-responsive img-thumbnail"/>
            <center>
                <a onclick="return ConfirmDel()" href="{{ route('AdminDeleteImage', ['id' => $value->ID_image]) }}">
                    {{ Form::button('Supprime', array('class' => 'btn btn-danger')) }}
                </a>
            </center>
        </div>
    @endforeach

@endsection