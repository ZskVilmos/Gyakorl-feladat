<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Models\real_estate;
use App\Models\real_estate_type;
use Dotenv\Validator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

#use Validator;



class HomeController extends Controller
{
    /**
     * Új ház feltöltő felület
     * Azonosító, teljes cím, ár, ingatlan jelleg
     * eloqent modell!
     * https://laravel.com/docs/8.x/eloquent
     */
    public function createRealEstateMenu()
    {

        $realEstateTypeOptions = real_estate_type::all();
        return view('realestate.create',[
            'realEstateTypeOptions' => $realEstateTypeOptions
        ]);
    }

    /**
     * Új ház feltöltése
     * Azonosító, teljes cím, ár, ingatlan jelleg
     * eloqent modell!
     * https://laravel.com/docs/8.x/eloquent
     */
    public function createRealEstate(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required|max:500',
            'address' => 'required',
            'type_name' => 'required',
            'file' => 'required',
            'price' => 'required',
        ]);

        if($validatedData){
            $filename = $_FILES['file']['name'];
            $location = "images/".$filename;

            /* $image = Input::file('img');
             $filename = time() . '.' . $image->getClientOriginalExtension();
             $path = public_path('images/' . $filename);
             Image::make($image->getRealPath())->save($path); //resize(400, 400)->*/
            //$user->image = $filename;
            //$user->save();


            $name = $validatedData["name"];
            $description = $validatedData["description"];
            $address = $validatedData["address"];
            $type_name = $validatedData["type_name"];
            $price = $validatedData["price"];

            // real_estate
            $find_type_id = real_estate_type::where('name', $type_name)->firstOrFail();

            $actualReal_estate = new real_estate();
            $actualReal_estate->name = $name;
            $actualReal_estate->description = $description;
            $actualReal_estate->address = $address;
            $actualReal_estate->type_id = $find_type_id->id;
            $actualReal_estate->price = floatval($price);
            $actualReal_estate->img_uri = $filename;
            $actualReal_estate->save();
            if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
                return redirect()->back()->with('success', 'Sikeres feltöltés!');
            } else {
                return redirect()->back()->with('alert', 'Sikertelen feltöltés!');
            }
        } else {
            return redirect()->back()->with('alert', 'Sikertelen feltöltés!');
        }
    }


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
        // adatok validálása, eredetileg az adatbázisban 500 ra van korlátozva a maxímum karakter szám,
        // ezért ezt itt is lekell ellenőrizni, hogy a felhasználó tudja, hogy túl hosszú szöveget adott meg,
        // ezt jelezni is fogom lehetőségként a view-ban.
        $validatedData = $request->validate([
            'real_estate_id' => 'required',
            'name' => 'required',
            'description' => 'required|max:500',
            'address' => 'required',
            'type_name' => 'required',
            'price' => 'required',
        ]);
        //elmentem az inputból kinyert adatokat
        $name = $validatedData["name"];
        $description = $validatedData["description"];
        $address = $validatedData["address"];
        $type_name = $validatedData["type_name"];
        $price = $validatedData["price"];

        // név alapján megkeresem a hozzátartozó id-t, mivel új fajta háztípust nem tudnak hozzáadni felhasználói
        // szinten, ezért nem védettem le egyedi névvel, hiszen nem lesz véletlenül se kettő ugyanojan nevű adat
        // természetesen ha a felhasználó tudna háztípust is megadni, akkor lekellene védetni, de most jó a firstOrFail
        // lekérdezés is, hogy megkapjuk a type_id-t
        $find_type_id = real_estate_type::where('name', $type_name)->firstOrFail();

        // pédányosítom objektummá a feltöltött adatot, az inputokból nyert adatokkal átírom, és elmentem
        $actualReal_estate = real_estate::findOrFail($validatedData["real_estate_id"]);
        $actualReal_estate->name = $name;
        $actualReal_estate->description = $description;
        $actualReal_estate->address = $address;
        $actualReal_estate->type_id = $find_type_id->id;
        $actualReal_estate->price = floatval($price);
        $actualReal_estate->price = floatval($price);
        $actualReal_estate->save();

        if($validatedData){
            // ha sikeres volt, visszaküldöm jelzésképp
            return redirect()->back()->with('success', 'Sikeres módosítás!');
        } else {
            // eredetileg ez nem fog lefutni, de a biztonság kedvéért írtam egy ilyet is ha a validált adatokkal nem sikerülne a feltöltés
            return redirect()->back()->with('alert', 'Sikertelen módosítás!');
        }
    }
    /**
     * @param $id
     * azonosito alapjan SOFT delete
     */
    public function deleteRealEstate($id)
    {
        $actual_Real_estate = real_estate::findOrFail($id);
        $actual_Real_estate->delete();
        if($actual_Real_estate){
            // törlés után (softDelete-vel), vissza jelzést küldök a felhasználónak
            return redirect('/')->with('success', 'Sikeres törlés!');
        } else {
            // sikertelen törlés után , vissza jelzést küldök a felhasználónak, elvileg a program jelenlegi állapotában ez sem történhet meg
            return redirect('/')->with('success', 'Sikertelen törlés!');
        }
    }
}
