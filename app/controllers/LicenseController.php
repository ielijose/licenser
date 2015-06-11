<?php

class LicenseController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /branch
	 *
	 * @return Response
	 */
	public function index()
	{
		$licenses = License::all();

		return View::make('backend.licenses.index', compact('licenses'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /branch
	 *
	 * @return Response
	 */
	public function store()
	{
		$inputs = Input::all();
		$inputs['license'] = "<<<LICENSER".sha1(mt_rand(10000,99999).time().$inputs['name']).
			sha1($inputs['name'].time().mt_rand(10000,99999)).
			sha1($inputs['name'].mt_rand(10000,99999).time()).
			sha1($inputs['name'].time().uniqid()).
			sha1(uniqid().$inputs['name'].time())."LICENSER>>>";

		$inputs['user_id'] = Auth::user()->id;

		$license = new License($inputs);
		if ($license->save())
		{
			return Redirect::to('/licenses')->with('alert', ['type' => 'success', 'message' => 'La licencia ha sido generada con exito.']);;
		}
		return Redirect::to('/licenses')->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);;

	}

	/**
	 * Display the specified resource.
	 * GET /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$license = License::findOrFail($id);
		return View::make('backend.licenses.show', compact('license'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /branch/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$property = Property::findOrFail($id);
		return View::make('backend.landings.edit', compact('property'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$inputs = Input::all();
		$book = Book::findOrFail($id);
		$book->fill($inputs);
		if ($book->save())
		{
			return Redirect::to('/libros/' . $id)->with('alert', ['type' => 'success', 'message' => 'Datos guardados.']);
		}
        return Redirect::to('/libros/' . $id)->with('alert', ['type' => 'danger', 'message' => 'Ocurrio un error, intenta mas tarde.']);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /branch/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$license = License::find($id);
		if($license->status == 'used'){
			return Redirect::to('/licenses/' . $id)->with('alert', ['type' => 'danger', 'message' => 'No puedes borrar una licencia en uso.']);
		}else{
			License::destroy($id);
			return Redirect::to('/licenses')->with('alert', ['type' => 'success', 'message' => 'El libro ha sido borrado.']);
		}
	}

}

