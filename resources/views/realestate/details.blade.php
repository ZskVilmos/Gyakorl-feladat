{{--
most-beugrok-mert-jo-gyakornok-vagyok
___________________
Developer: vinczej
Created at: 2021.03.24.
--}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">




            <h3 class="text-center">Ingatlan részletek</h3>
            <h4>Ház neve: {{ $actualRealEstate->name }}</h4>
            <p>Leírás: {{ $actualRealEstate->description }}</p>
            <p>Cím: {{ $actualRealEstate->address }}</p>
            <p>Ház típusa: {{ $actualRealEstateTypeName}}</p>
            <p>Feltöltés ideje: {{ $actualRealEstate->created_at }}</p>
            <p>Módosítás ideje: @if($actualRealEstate->updated_at == null)
                                    {{$actualRealEstate->created_at}}
                                @else
                                    {{$actualRealEstate->updated_at}}
                                @endif</p>
            <p>Ár {{intval($actualRealEstate->price)}} ft</p>

        </div>
    </div>
@endsection
