<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\real_estate;
use App\Models\real_estate_type;
use Dotenv\Validator;
use Illuminate\Support\Facades\Redirect;

#use Validator;



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
        // *2 itt sem szabadna az összeset lekérdezni egyszerre a memória túlcsordulás miatt.
        // De a beugró feladatba nem rakok olyan sok házat, hogy ez bekövetkezzen.
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
     * @param $id
     * Egy felületet ad, ahol meg lehet változtatni az adatokat, későbbiekben amikor regisztrálni is kell,
     * akkor jól fog jönni hogy külön van, és csak regisztrált ügyfeleknek jelenik meg pl a módosít gomb.
     */
    public function updateRealEstateMenu($id)
    {
        $actualRealEstate = real_estate::findOrFail($id);
        $actualRealEstateTypeName = real_estate_type::findOrFail($actualRealEstate->type_id);
        // *1 Eredetileg egy adatbázisból sem kérdezném le egyszerre az összes adatot, mert több ezer rekord
        // lekérdezésénél memória túlcsordulás léphet fel, ezért darabokban érdemes leszedni,
        // itt viszont tudom hogy ez a veszély nem áll fent, mert nincs olyan sok háztipus eltárolva,
        // ezért itt lemerem egyben kérni az összeset.
        $realEstateTypeOptions = real_estate_type::all();
        return view('realestate.update', ['actualRealEstate'=>$actualRealEstate, 'actualRealEstateTypeName'=>$actualRealEstateTypeName->name, 'realEstateTypeOptions'=>$realEstateTypeOptions, 'msg' => ""]);
    }

    /**
     * @param Request $request
     * Ingatlan adatainak modositasa
     * Validacio model szerinti megkötésekkel
     */
    public function updateRealEstate(Request $request)
    {
        $validatedData = $request->validate([
            'real_estate_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'type_name' => 'required',
            'price' => 'required',
        ]);



        $name = $validatedData["name"];
        $description = $validatedData["description"];
        $address = $validatedData["address"];
        $type_name = $validatedData["type_name"];
        $price = $validatedData["price"];

        // real_estate
        $find_type_id = real_estate_type::where('name', $type_name)->firstOrFail();

        $actualReal_estate = real_estate::findOrFail($validatedData["real_estate_id"]);
        $actualReal_estate->name = $name;
        $actualReal_estate->description = $description;
        $actualReal_estate->address = $address;
        $actualReal_estate->type_id = $find_type_id->id;
        $actualReal_estate->price = floatval($price);
        $actualReal_estate->save();

            // real_estate_type

        //$find_type_id = real_estate_type::where('name', $type_name)->firstOrFail();
        //$type_id = $find_type_id->type_id;



        if($validatedData){

            return redirect()->back()->with('success', 'Sikeres módosítás!');

        } else {

            //return Redirect::back()->withErrors(['msg' => 'The Message']);
        }

        //return view('realestate.details', ['actualRealEstate'=>$actualRealEstate, 'actualRealEstateTypeName'=>$actualRealEstateTypeName->name]);


        //return redirect()->back();

        /*$validator = new Validator($request->all(), []);
        return view("realestate.update", ["request" => $request]);*/

    }
    /**
     * @param $id
     * azonosito alapjan SOFT delete
     */
    public function deleteRealEstate($id)
    {

    }
}
