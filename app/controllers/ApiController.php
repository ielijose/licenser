<?php

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

}