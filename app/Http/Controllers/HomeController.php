<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\real_estate;
use App\Models\real_estate_type;
use Validator;


class HomeController extends Controller
{
    /**
     * Adja vissza az ingatlanok listáját
     * Azonosító, teljes cím, ár, ingatlan jelleg
     * eloqent modell!
     * https://laravel.com/docs/8.x/eloquent
     */
    public function listRealEstate()
    {
        $realEstatesList = real_estate::all();

        return view('realestate.index', [
            'real_estate' => $realEstatesList,
        ]);
    }

    /**
     * @param $id
     * Ajda vissza egy ingatlan adatlapját
     * eloqent modell használata elkerülhetetlen
     * https://laravel.com/docs/8.x/eloquent
     */
    public function getRealEstate($id)
    {
        $actualRealEstate = real_estate::findOrFail($id);
        $actualRealEstateTypeName = real_estate_type::findOrFail($actualRealEstate->type_id);
        return view('realestate.details', ['actualRealEstate'=>$actualRealEstate, 'actualRealEstateTypeName'=>$actualRealEstateTypeName->name]);
    }

    /**
     * @param Request $request
     * Ingatlan adatainak modositasa
     * Validacio model szerinti megkötésekkel
     */
    public function updateRealEstate(Request $request)
    {
        $validator = new Validator($request->all(), []);

    }

    /**
     * @param $id
     * azonosito alapjan SOFT delete
     */
    public function deleteRealEstate($id)
    {

    }
}
