<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;
use App\Models\Pricing;

class AjaxController extends Controller
{
    public function location($id) {
        $destination = Pricing::where('pickup_id', $id)->get();
        return response()->json(array('destination'=> $destination), 200);
    }

    public function getFaq($id){
        $faq = faq::where('id', $id)->get();
        return response()->json(array('faq'=> $faq), 200);
    }
}
