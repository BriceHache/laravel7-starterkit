<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utilities\AdminSettingsController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

class DataController extends Controller
{


    protected $global_settings = null;


    public function __construct()
    {

        $this->global_settings = new AdminSettingsController();

    }

    public function index()
    {

    $result['template_settings'] = $this->global_settings->gettemplateSettings();;

    return view('dashboards.tenant_dashboard')
        ->with(['result'=> $result]);
    }

    public function template_settings(){


        $result['template_settings'] = $this->global_settings->gettemplateSettings();

        return view('admin.template.template_settings')->with(['result'=> $result]);
    }

    public function login(){

        $result['template_settings'] = $this->global_settings->gettemplateSettings();

        if (Sentinel::check()) {
            return Redirect::route('admin.dashboard');

        }else{

            return view("admin.auth.login")->with('result', $result);
        }
    }

    public function page404(){

        $result['template_settings'] = $this->global_settings->gettemplateSettings();
        return view("admin.errors.404")->with('result', $result);
    }

    public function page500(){

        $result['template_settings'] = $this->global_settings->gettemplateSettings();
        return view("admin.errors.500")->with('result', $result);
    }


    public function save_template_settings(Request $request){

       // dd($request);

        foreach($request->all() as $key => $value){
            if($key != 'oldImage_login_image'){
                if($key=='image_login' ){
                    if($request->hasFile('image_login') and in_array($request->image_login->extension(), $this->global_settings->imageType())){
                        $dir="resources/assets/images/login_page/";
                        if (!file_exists($dir) and !is_dir($dir)) {
                            mkdir($dir);
                        }
                        $image = $request->image_login;
                        $fileName = time().'.'.$image->getClientOriginalName();
                        $image->move('resources/assets/images/login_page/', $fileName);
                        $value = 'resources/assets/images/login_page/'.$fileName;

                    }else{
                        $value = $request->oldImage_login_image;
                    }
                }

                $checkExist = DB::table('template_settings')->where('name','=', $key)->first();

                if($checkExist){
                    DB::table('template_settings')->where('name','=', $key)->update([
                        'value'			=>	addslashes($value),
                        'updated_at'	=>	date('Y-m-d H:i:s')
                    ]);
                }else{
                    DB::table('template_settings')->insertGetId([
                        'value'			=>	addslashes($value),
                        'name'			=>	$key,
                        'created_at'	=>	date('Y-m-d H:i:s')
                    ]);
                }
            }
        }

        return back()->with('success', __('template_settings.updatewithsuccess'));

    }


    public function checkLogin(){

    }

}
