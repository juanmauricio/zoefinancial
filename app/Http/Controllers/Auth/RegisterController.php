<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use GuzzleHttp\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registraton request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:3'],
            'gender' => ['required', 'string'],
            'zipcode' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Gets geographical data from GOOGLE's Geocoding API based on ZIP code.
     *
     * @param  string  $zipcode
     * @return $geodata
     */
    protected function getGeographicalData(string $zipcode){
        $client = new Client(['base_uri' => 'https://maps.googleapis.com/maps/api/geocode/']);
        $response = $client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $zipcode . '&key=AIzaSyBZw_lLpLQe1jJErMTEIOLBK1nlWnfsu7g');
        $geodata = $response->getBody()->getContents();
        return $geodata;
    }

    /**
     * Obtains the latitude and longitude from data returned by GOOGLE's Geocoding API
     *
     * @param  array  $data
     * @return array  $result3
     */
    protected function getLatLon(string $geodata){
        $result = json_decode($geodata, true);
        $result1[]=$result['results'][0];
        $result2[]=$result1[0]['geometry'];
        $result3[]=$result2[0]['location'];
        return $result3[0];
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $geodata = $this->getGeographicalData($data['zipcode']);
        $coordinates = $this->getLatLon($geodata);
        $lat = $coordinates['lat'];
        $lng = $coordinates['lng'];
        // dd($lat. '-' . $lon);

        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'age' => $data['age'],
            'gender' => $data['gender'],     
            'zipcode' => $data['zipcode'],
            'profession' => $data['profession'],                                  
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'geographicdata' => $geodata,
            'lat' => $lat,
            'lng' => $lng
        ]);
    }
}
