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
            <h3 class="text-center">Ingatlanok listája</h3>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <div class="row">
                <form class="form-group col-12 col-sm-6" action="/create-real-estate" method="GET">
                    @csrf
                    <input class="btn btn-primary ml-3" type="submit"  value="Új ingatlan Feltöltése">
                </form>
                <div class="col-12 col-sm-6 row">
                    <form class="form-group col-12 col-sm-10" action="/list-Real-Estate-In-Type" method="POST">
                        @csrf
                        <div class="input-group">
                            <select class="form-control input-group-addon" name="type_id">
                                @foreach($real_estate_type as $realEstateType)
                                    <option value="{{$realEstateType->id}}"> {{$realEstateType->name}} </option>
                                @endforeach
                            </select>
                            <input class="input-group-addon btn btn-primary" type="submit" value="Ingatlan típus kiválasztása">
                        </div>
                    </form>
                </div>
            </div>

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif

            <!-- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ---------- ----------  -->

            <div class="row d-flex align-items-center">
                @foreach($real_estate as $realEstate)
                    <form class="form-group col-12 col-md-6" action="/get-real-estate/{{$realEstate->id}}" method="GET">
                        @csrf
                        <div class="p-3 rounded">
                            <div class="d-flex justify-content-center">
                                <img class="img-fluid w-100 h-auto d-inline-block rounded-top"src="{{ $realEstate->img_uri }}"  alt="vizuális grafikai elem"> <br>
                            </div>
                            <input class="btn btn-primary form-control rounded-bottom" style="border-top-left-radius: 0px!important; border-top-right-radius: 0px;!important" type="submit" value="Részletek">
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
