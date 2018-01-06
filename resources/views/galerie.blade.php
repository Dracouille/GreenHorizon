<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>

@include('layouts.head')
@extends('layouts.footer')
@include('layouts.NavBar')

<div class="container">
    <div class="row">
        <div class="box">
            {{--<div id="slide" class="carousel slide" data-ride="carousel">--}}
            <div id="slide" class="carousel slide col-lg-10 col-sm-offset-1" data-ride="carousel" align="center">
                @php ($i = 1)
                <div class="carousel-inner" role="listbox">
                    @foreach($MesFav as $key => $value)
                        @if($i == 1)
                            @php ($i = 2)
                            <div class="item active">
                                <img src="{{asset($value->lien_image)}}" width="1100" height="500">
                            </div>
                        @else
                            <div class="item">
                                <img src="{{asset($value->lien_image)}}" width="1100" height="500">
                            </div>
                    @endif
                @endforeach

                <!-- Controls -->
                        <a class="left carousel-control" href="#slide" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#slide" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
