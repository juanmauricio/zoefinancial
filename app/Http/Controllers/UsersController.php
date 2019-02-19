<?php

namespace App\Http\Controllers;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Gets all users that are of type Contact
     *
     */
    public function findmatches($id){
        
        //Gets the agent.
        $agent = User::find($id);

        //Gets all contacts (users with profession NULL).
        $contacts = User::where('profession', '')->get();

        foreach ($contacts as $contact) {
            $distance = $this->calculateDistance($contact->lat, $contact->lng, $agent->lat, $agent->lng);
            $contact->distance = $distance;
        }
        $contacts  = $contacts -> sortBy("distance");
        return view('agentmatches')->with('contacts', $contacts);
    }

    public function testFunction(){
        
    }

    /**
     * Calculates distance in miles given lat & lng coordinates fro 2 points.
     *
     * @param $lat1
     * @param $lng1
     * @param $lat2
     * @param $lng2
     * @return number representing the distance in miles.
     */
    protected function calculateDistance($lat1, $lng1, $lat2, $lng2){
        $theta = $lng1-$lng2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
        cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        return $miles;
    }
}