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

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <a class="btn btn-primary" href="/">Vissza</a>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <h3 class="text-center">Ingatlan részletek</h3>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <form action="/update-real-estate/{{$actualRealEstate->id}}" method="GET">
                @csrf
                <h4>Ház neve: {{ $actualRealEstate->name }}</h4>
                <p>Leírás: {{ $actualRealEstate->description }}</p>
                <p>Cím: {{ $actualRealEstate->address }}</p>
                <p>Ház típusa: {{ $actualRealEstateTypeName}} </p>
                <p>Feltöltés ideje: {{ $actualRealEstate->created_at }}</p>
                <p>Módosítás ideje: @if($actualRealEstate->updated_at == null)
                                        {{$actualRealEstate->created_at}}
                                    @else
                                        {{$actualRealEstate->updated_at}}
                                    @endif</p>
                <p>Ár {{intval($actualRealEstate->price)}} ft.</p>
                <input class="btn btn-primary" type="submit" value="Módosítás">
            </form>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <form action="/delete-real-estate/{{$actualRealEstate->id}}" method="GET">
                @csrf
                <button class="btn btn-danger mt-4" type="submit" onclick="return confirm('Biztos hogy törölni akarod?')">Törlés </button>
            </form>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

        </div>
    </div>
@endsection
