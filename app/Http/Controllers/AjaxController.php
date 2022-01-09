<?php

namespace App\Http\Controllers;

use App\Models\faq;
// use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Location;
use App\Models\State;
use stdClass;

class AjaxController extends Controller 
{
    public function location($id) {
        $destinations = Pricing::where('pickup_id', $id)->get();
        $states = [];
        $locales = new stdClass();
        
        foreach ($destinations as $destination) {
            $dropoff = Location::where('id', $destination->dropoff_id)->first();
            $state = State::where('id', $dropoff->state_id)->first();
            array_push($states, $state);
            $states = array_unique($states);
        }
        foreach ($states as $state) {
            $id = $state->id;
            $locales->$id = [];
        }
        foreach ($destinations as $destination) {
            $dropoff = Location::where('id', $destination->dropoff_id)->first();
            $state = State::where('id', $dropoff->state_id)->first();
            $id = $state->id;
            array_push($locales->$id, $destination);
        }

        return response()->json(array('destination' => $destinations, 'states' => $states, 'locales' => $locales), 200);
    }

    public function state($id) {
        $locations = Location::where('state_id', $id)->get();
        return response()->json(array('locations'=> $locations), 200);
    }

    public function getFaq($id){
        $faq = faq::where('id', $id)->get();
        return response()->json(array('faq'=> $faq), 200);
    }
}
