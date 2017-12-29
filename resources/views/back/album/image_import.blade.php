@extends('back.layout')
@section('title', 'Gestion des images')
@section('desc', 'Import des images par type')
@section('main')

    <h2 style="color: #00a65a"> Importer dans la catégorie : {{$MonType->Nom_type_image}} </h2>

    {!! Form::open(array('route' => ['AdminStoreImage', $MonType->ID_type_image])) !!}
    {!! csrf_field() !!}


    {{ Form::close() }}

@endsection