<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function sendForm(Request $request) {
	   print_r($request->all());
    }
}
