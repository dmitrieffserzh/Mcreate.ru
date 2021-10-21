<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestForm;

class RequestFormController extends Controller {
	public function sendFormFeedback( Request $request ) {
		$req = new RequestForm();

		$req->name       = $request->name;
		$req->phone      = $request->phone;
		$req->message    = $request->message;
		$req->type       = $request->type;
		$req->page_url   = $request->page_url;
		$req->agreement  = 1;
		$req->ip         = $request->ip() ? $request->ip() : 'Не определен';
		$req->user_agent = $request->userAgent() ? $request->userAgent() : 'Не определен';

		if($req->save()) {
			return json_encode("{stasus : send}");
		}

	}
}
