@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <a class="btn btn-primary" href="/">Vissza</a>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <h3 class="text-center">Ingatlan részleteinek megváltoztatása </h3>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

        <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            @if (\Session::has('alert'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('alert') !!}</li>
                    </ul>
                </div>
            @endif

        <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <form class="form-group" action="/update-real-estate" method="POST">
                @csrf
                <input type="hidden" name="real_estate_id" value="{{ $actualRealEstate->id }}">
                <p>Ház neve:<input class="form-control" type="text" name="name" value="{{ $actualRealEstate->name }}"> </p>
                <p class="text-danger">@error('name') {{"Név megadása kötelező!"}} @enderror</p>
                <p>Leírás: <textarea class="form-control h-50" name="description">{{ $actualRealEstate->description }} </textarea></p>
                <p class="text-danger">@error('description') {{"Leírás megadása kötelező!"}} @enderror</p>
                <p>Cím: <input class="form-control" type="text" name="address" value="{{ $actualRealEstate->address }}"></p>
                <p class="text-danger">@error('address') {{"Házcím megadása kötelező!"}} @enderror</p>
                <p>Ház típusa:
                    <select class="form-control" name="type_name">
                        @foreach($realEstateTypeOptions as $option)
                            @if($option->name == $actualRealEstateTypeName)
                                <!-- ez azért kell, hogy az alapból elmentett legyen kiválasztva a mezőben,
                                hogy a felhasználó ha ezt nem akarja változtatni, akkor ne mindig a legfelső
                                jelenjen meg neki, és nekeljen átállítania (elfelejtheti meg amúgy is kézenfekvő hogy így legyen megcsinálva)-->
                                <option id="{{$option->id}}" value="{{$option->name}}" selected> {{$option->name}} </option>
                            @else
                                <option id="{{$option->id}}" value="{{$option->name}}"> {{$option->name}} </option>
                            @endif
                        @endforeach
                    </select>
                    </p>
                    <div class="input-group">
                        <span class="input-group-addon mt-2 mr-2">Ár:</span><input class="form-control" type="number" name="price" value="{{intval($actualRealEstate->price)}}"><span class="input-group-addon mt-2 ml-2">ft.</span>
                    </div>
                <p class="text-danger">@error('price') {{"Ár megadása kötelező!"}} @enderror</p>
                <input class="form-control btn btn-primary" type="submit" value="Módosítás" name="submit">
            </form>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

        </div>
    </div>
@endsection
