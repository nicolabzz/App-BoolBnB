<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Service;
use App\Apartment;
use GuzzleHttp\Client;
use App\Sponsorship;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    private $validation = [
        'user_id'           => 'integer|exist:users,id',
        'title'             => 'string|required|max:100',
        'slug'              => [
            'required',
            'string',
            'max:100',
        ],
        'n_rooms'           => 'integer|required',
        'n_beds'            => 'integer|required',
        'n_bathrooms'       => 'integer|required',
        'square_meters'     => 'integer|required',
        'picture'           => 'url',
        'visibility'        => 'boolean',
        'latitude'          => 'float|between:-90,90',
        'longitude'         => 'float|between:-180,180',
        'state'             => 'required|string|max:100',
        'city'              => 'required|string|max:200',
        'address'           => 'required|string|max:250',
        'apartment_number'  => 'integer|required'
    ];

    private $validation_store = [
        'uploaded_image'    => 'required|image',
    ];

    private $validation_update = [
        'uploaded_image'    => 'nullable|image',
    ];


    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->paginate();
        $services = Service::all();
        $sponsorships = Sponsorship::all();
        return view('admin.apartments.index', [
            'apartments'   => $apartments,
            'services'     => $services,
            'sponsorships' => $sponsorships,
        ]);
    }


    public function create()
    {
        $services = Service::all();

        return view('admin.apartments.create', [
            'services'          => $services,
        ]);

        return view('admin.apartments.create');
    }


    public function store(Request $request)
    {

        $this->validation_store['slug'][] = 'unique:apartments';
        $request->validate($this->validation);
        $request->validate($this->validation_store);

        $data = $request->all();

        // $img_path = Storage::put('uploads', $data['uploaded_image']);

        // Le righe di codice sottostante funzionano per windows 11, per gli altri non serve
        //--------------------------------------------------------------------------
        $img_path = Storage::put('public/uploads', $data['uploaded_image']);
        $img_path = isset($img_path) ? str_replace('public/', '', $img_path) : null;
        //---------------------------------------------------------------------------


        // Recupera dati api tomtom
        $client = new Client();
        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->get("https://api.tomtom.com/search/2/geocode/{$data['address']}.json?key=gMfd6J6PIRqQQaAmyKd2WQbENA4FkXwr");
        $response = $client->get("https://api.tomtom.com/search/2/structuredGeocode.json?streetNumber={$data['apartment_number']}&streetName={$data['address']}&municipality={$data['city']}&countrySubdivision={$data['state']}&countryCode=IT&key=gMfd6J6PIRqQQaAmyKd2WQbENA4FkXwr");

        $responseBody = json_decode($response->getBody()->getContents(), true);

        if (count($responseBody['results']) > 0) {
            $latitude = $responseBody['results'][0]['position']['lat'];
            $longitude = $responseBody['results'][0]['position']['lon'];
        } else {
            // Tratta il caso in cui l'indirizzo non viene trovato
            $latitude = null;
            $longitude = null;
            // Puoi restituire un messaggio di errore o mostrare una pagina di errore all'utente
            return redirect()->back()->with('error', 'Indirizzo non trovato, verifica di aver inserito un indirizzo valido.');
        }
        // fine recupero dati api tomtom


        $apartment = new Apartment;
        $apartment->user_id          =    auth()->user()->id;
        $apartment->title            =    $data['title'];
        $apartment->slug             =    $data['slug'];
        $apartment->n_rooms          =    $data['n_rooms'];
        $apartment->n_beds           =    $data['n_beds'];
        $apartment->n_bathrooms      =    $data['n_bathrooms'];
        $apartment->square_meters    =    $data['square_meters'];
        $apartment->uploaded_image   =    $img_path;
        $apartment->visibility       =    isset($data['visibility']) && $data['visibility'] !== '' ? $data['visibility'] : 1;
        $apartment->latitude         =    $latitude;
        $apartment->longitude        =    $longitude;
        $apartment->state            =    $data['state'];
        $apartment->city             =    $data['city'];
        $apartment->address          =    $data['address'];
        $apartment->apartment_number =    $data['apartment_number'];



        $apartment->save();

        if (isset($data['services'])) {
            $apartment->services()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment]);
    }


    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
    }


    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        if (Auth::id() !== $apartment->user_id) abort(401);

        return view('admin.apartments.edit', [
            'apartment' => $apartment,
            'services' => $services,
        ]);
    }


    public function update(Request $request, Apartment $apartment)
    {
        $this->validation_update['slug'][] = Rule::unique('apartments')->ignore($apartment);
        $request->validate($this->validation_update);
        $request->validate($this->validation);
        if (Auth::id() !== $apartment->user_id) abort(401);

        $data = $request->all();

        if (isset($data['uploaded_image'])) {
            // $img_path = Storage::put('uploads', $data['uploaded_image']);

            // Le righe di codice sottostante funzionano per windows 11, per gli altri non serve
            //--------------------------------------------------------------------------
            $img_path = Storage::put('public/uploads', $data['uploaded_image']);
            $img_path = isset($img_path) ? str_replace('public/', '', $img_path) : null;
            //---------------------------------------------------------------------------

            Storage::delete($apartment->uploaded_image);
        } else {
            $img_path = $apartment->uploaded_image;
        }

        $client = new \GuzzleHttp\Client([
            'verify' => false
        ]);

        $response = $client->get("https://api.tomtom.com/search/2/structuredGeocode.json?streetNumber={$data['apartment_number']}&streetName={$data['address']}&municipality={$data['city']}&countrySubdivision={$data['state']}&countryCode=IT&key=gMfd6J6PIRqQQaAmyKd2WQbENA4FkXwr");

        $responseBody = json_decode($response->getBody()->getContents(), true);

        if (count($responseBody['results']) > 0) {
            $latitude = $responseBody['results'][0]['position']['lat'];
            $longitude = $responseBody['results'][0]['position']['lon'];
            $state = $responseBody['results'][0]['address']['countrySubdivision'];
            $city = $responseBody['results'][0]['address']['municipality'];
            $address = $responseBody['results'][0]['address']['streetName'];
            $apartment_number = $responseBody['results'][0]['address']['streetNumber'];
        } else {
            $latitude = null;
            $longitude = null;
            $state = $data['state'];
            $city = $data['city'];
            $address = $data['address'];
            $apartment_number = $data['apartment_number'];
            return redirect()->back()->with('error', 'Indirizzo non trovato, verifica di aver inserito un indirizzo valido.');
        }

        $apartment->title            =    $data['title'];
        $apartment->slug             =    $data['slug'];
        $apartment->n_rooms          =    $data['n_rooms'];
        $apartment->n_beds           =    $data['n_beds'];
        $apartment->n_bathrooms      =    $data['n_bathrooms'];
        $apartment->square_meters    =    $data['square_meters'];
        $apartment->uploaded_image   =    $img_path;
        $apartment->visibility       =    isset($data['visibility']) && $data['visibility'] !== '' ? $data['visibility'] : 1;
        $apartment->latitude = $latitude;
        $apartment->longitude = $longitude;
        $apartment->state            =    $data['state'];
        $apartment->city             =    $data['city'];
        $apartment->address          =    $data['address'];
        $apartment->apartment_number =    $data['apartment_number'];
        $apartment->update();

        if (isset($data['services'])) {
            $apartment->services()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', ['apartment' => $apartment]);
    }


    public function destroy(Apartment $apartment)
    {
        if (Auth::id() !== $apartment->user_id) abort(401);
        $apartment->services()->detach();
        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('success_delete', $apartment);
    }

    // public function slug(Request $request) {
    //     // localhost:8000/admin/categories/slug?title=ciao a tutti

    //     $title = $request->query('title');

    //     // risponde con il primo slug disponibile restituito in formato JSON per essere usato da JS
    //     $slug = Category::getSlug($title);

    //     return response()->json([
    //         'slug'  => $slug,
    //     ]);
    // }
}
