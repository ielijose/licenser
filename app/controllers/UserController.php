<?php

class UserController extends BaseController {

	public function dashboard()
	{
		return View::make('backend.dashboard');
	}

    /* SETTINGS */

    public function payments()
    {
        $payments = Payment::all();
        return View::make('backend.payments.index', compact('payments'));
    }

    public function settings()
    {
        return View::make('backend.pages.settings');
    }

    public function settings_post()
    {
        $inputs = Input::all();

        foreach ($inputs as $key => $value) {
            $setting = Setting::firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }
        return Redirect::to('/settings')->with('alert', ['type' => 'success', 'message' => 'Configuración guardada.']);
    }
}