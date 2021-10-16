@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <a class="btn btn-primary" href="/">Vissza</a>
            <h3 class="text-center">Ingatlan részleteinek megváltoztatása </h3>
            @if($errors->any)
                @if($errors == "1")
                    <h4>Sikeres módosítás</h4>
                    Sessions::get('msg')
                @endif
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            <form class="form-group" action="/update-real-estate" method="POST">
                @csrf
                <input type="hidden" name="real_estate_id" value="{{ $actualRealEstate->id }}">
                <p>Ház neve:<input class="form-control" type="text" name="name" value="{{ $actualRealEstate->name }}"> </p>
                <p class="text-danger">@error('name') {{$message}} @enderror</p>
                <p>Leírás: <textarea class="form-control h-50" name="description">{{ $actualRealEstate->description }} </textarea></p>
                <p class="text-danger">@error('description') {{$message}} @enderror</p>
                <p>Cím: <input class="form-control" type="text" name="address" value="{{ $actualRealEstate->address }}"></p>
                <p class="text-danger">@error('address') {{$message}} @enderror</p>
                <p>Ház típusa:
                    <select class="form-control" name="type_name">
                        @foreach($realEstateTypeOptions as $option)
                            @if($option->name == $actualRealEstateTypeName)
                                <option id="{{$option->id}}" value="{{$option->name}}" selected> {{$option->name}} </option>
                            @else
                                <option id="{{$option->id}}" value="{{$option->name}}"> {{$option->name}} </option>
                            @endif
                        @endforeach
                    </select>
                    </p>
                <p class="text-danger">@error('type_name') {{$message}} @enderror</p>
                <div class="row mb-3">
                    <div class="col-11">Ár: <input class="form-control" type="number" name="price" value="{{intval($actualRealEstate->price)}}"></div><div class="col-1 mt-4 pt-2">ft.</div>
                </div>
                <p class="text-danger">@error('price') {{$message}} @enderror</p>
                <input class="form-control btn btn-primary" type="submit" value="Módosítás" name="submit">
            </form>
        </div>
    </div>
@endsection
