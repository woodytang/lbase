<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\FeatureRequest;
use App\Http\Requests\LarabaseRequest;
use Illuminate\Http\Request;
use Offline\Settings\Facades\Settings;

class SettingsController extends Controller {

	public function getFeatures(){

        $ids = Settings::get('features');

        return view('admin.settings.feature',compact('ids'));


    }

    /**
     * @param FeatureRequest $request
     * @return \Illuminate\View\View
     */
    public function postFeatures(FeatureRequest $request){

        $data = $request->except('_token','_url');

        //dd($data);

        Settings::set('features', $data);

        //dd(Settings::get('features'));

        app('flash')->message('保存成功');

        return redirect()->back();


    }

    public function getOptions(){




        $options = Settings::get('options');

        return view('admin.settings.options',compact('options'));


    }

    public function postOptions(LarabaseRequest $request){

        $data = $request->except('_token');

        //dd($data);

        Settings::set('options', $data);

        //dd(Settings::get('features'));

        app('flash')->message('保存成功');

        return redirect()->back();


    }

}
