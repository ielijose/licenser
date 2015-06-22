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

        if(Input::hasFile('plugin')){
            $file = Input::file('plugin');
            $name = time() . '-' . Str::slug($file->getClientOriginalName()).".".$file->getClientOriginalExtension();
            $moved = $file->move(public_path() . '/uploads/plugins/', $name);

            $plugin = Setting::firstOrNew(['key' => 'plugin_zip']);
            $plugin->value = $name;
            $plugin->save();
            $pluginPath = Setting::firstOrNew(['key' => 'plugin_zip_path']);
            $pluginPath->value = public_path() . '/uploads/plugins/'. $name;
            $pluginPath->save();
        }

        foreach ($inputs as $key => $value) {
            $setting = Setting::firstOrNew(['key' => $key]);
            $setting->value = $value;
            $setting->save();
        }
        return Redirect::to('/settings')->with('alert', ['type' => 'success', 'message' => 'Configuración guardada.']);
    }
}