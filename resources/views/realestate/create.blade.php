@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <a class="btn btn-primary" href="/">Vissza</a>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <h3 class="text-center">Ingatlan készítése </h3>

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

            <form class="form-group" action="/creating-real-estate" enctype="multipart/form-data" method="POST">
                @csrf
                <p>Ház neve:<input class="form-control" type="text" name="name" value=""> </p>
                <p class="text-danger">@error('name') {{"Név megadása kötelező!"}} @enderror</p>
                <p>Leírás: <textarea class="form-control h-50" name="description"></textarea></p>
                <p class="text-danger">@error('description') {{"Leírás megadása kötelező!"}} @enderror</p>
                <p>Cím: <input class="form-control" type="text" name="address" value=""></p>
                <p class="text-danger">@error('address') {{"Házcím megadása kötelező!"}} @enderror</p>
                <p>Ház típusa:
                    <select class="form-control" name="type_name">
                        @foreach($realEstateTypeOptions as $option)
                            <option id="{{$option->id}}" value="{{$option->name}}"> {{$option->name}} </option>
                        @endforeach
                    </select>
                </p>
                <button class="btn btn-primary" type="button" onclick="document.getElementById('getImg').click()">Kép feltöltése</button>
                <input type='file' id="getImg" name="file" style="display:none">
                <p class="text-danger">@error('file') {{"Kép feltöltése kötelező!"}} @enderror</p>
                <div class="row mb-3">
                    <div class="col-11">Ár: <input class="form-control" type="number" name="price" value=""></div><div class="col-1 mt-4 pt-2">ft.</div>
                </div>
                <p class="text-danger">@error('price') {{"Ár megadása kötelező!"}} @enderror</p>
                <input class="form-control btn btn-primary" type="submit" value="Elkészítés" name="submit">
            </form>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

        </div>
    </div>
@endsection
