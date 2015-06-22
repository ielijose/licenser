<?php
use Carbon\Carbon;

class ApiController extends BaseController {

	public function activate()
	{
		$inputs = Input::all();
		//dd($inputs);

		if(Input::has('license') && Input::has('domain')){
			//verify new licenses
			$license = License::available($inputs['license'])->first();
			if($license){
				$license->activate($inputs['domain']);
				return Response::json(["status" => 'active', "condition" => 'new']);
			}else{ //verify used licenses
				$license = License::where('domain', $inputs['domain'])->first();
				if($license){
					if($license->license == $inputs['license']){
						return Response::json(["status" => 'active', "condition" => 'reactivated']);
					}
				}
			}
		}
		return Response::json(["status" => 'invalid']);
	}

	public function download($token){
		$e = Expiration::where('token', $token)->first();
		if($e){

			$expirationDate = Carbon::parse($e->expiration);
			$now = Carbon::now();
			if($expirationDate->lte($now)){
				return Response::download(public_path() . '/uploads/plugins/' .Setting::key('plugin_zip')->first()->value);
			}else{
				echo "Su enlace ha expirado, consulte con el administraor del sistema";
			}
		}else{
			App::abort(403, 'Unauthorized action.');
		}
	}

}