<?php

namespace App\Http\Controllers;

use App\Mail\McSoniaTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //
    function testMail(){
        $details = [
            'name' => 'John Doe',
            'title' => 'Test Mail',
            'body' => 'This is for testing email durhhh'
        ];
       
        Mail::to('abiolamishael@gmail.com')->send(new McSoniaTestMail($details));
       
        dd("Email is Sent.");
    }
}
