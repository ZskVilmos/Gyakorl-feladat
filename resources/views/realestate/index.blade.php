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
            <div class="row d-flex align-items-center">
                @foreach($real_estate as $realEstate)
                    <form class="col-12 col-md-6" action="/get-real-estate/{{$realEstate->id}}" method="GET">
                        <div class="p-3 rounded">
                            <div class="d-flex justify-content-center ">
                                <img class="img-fluid w-100 h-50 rounded" src="{{ $realEstate->img_uri }}"  alt="vizuális grafikai elem"> <br>
                            </div>
                            <input type="submit" class="btn btn-secondary" value="Részletek">
                        </div>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
