@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Import des images par type')
@section('main')

    <head>
        <link rel="stylesheet" type="text/css" href="{{asset('AdminLTE/css/Perso.css')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <form enctype="multipart/form-data" method="post" action="{{ route('AdminStoreImage', ['id' => $MonType->ID_type_image]) }}" style="margin-left: 50px;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <label for="fileToUpload">Choisir les photos</label><br />
            <input accept="image/*" type="file" name="filesToUpload[]" id="filesToUpload" multiple="multiple" class="btn btn-default"/>
            <output id="filesInfo"></output>
        </div>
        <br>
        <div class="row">
            <input type="submit" value="Enregistrer" class="btn btn-success"/>
            <input type="button" onclick="vide()" value="Vider" class="btn btn-warning"/>
        </div>
    </form>


    <script>
        function vide() {
            document.getElementById('filesToUpload').value = "";
            document.getElementById('filesInfo').value = "";
        }

        function fileSelect(evt) {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var files = evt.target.files;

                var result = '';
                var file;

                for (var i = 0; file = files[i]; i++) {

                    // if the file is not an image, continue
                    if (!file.type.match('image.*')) {
                        continue;
                    }

                    reader = new FileReader();
                    reader.onload = (function (tFile) {
                        return function (evt) {

                            var div = document.createElement('div');
                            div.innerHTML = '<img style="width: 120px;" src="' + evt.target.result + '" />';
                            div.className = 'imageimport img-responsive img-thumbnail';
                            div.id = "images"
                            document.getElementById('filesInfo').appendChild(div);
                        };
                    }(file));
                    reader.readAsDataURL(file);
                }
            } else {
                alert('Affichage impossible.');
            }
        }

        document.getElementById('filesToUpload').addEventListener('change', fileSelect, false);
    </script>

@endsection