<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;

class BriceHacheController extends Controller
{
    /**
     * Message bag.
     *
     * @var Illuminate\Support\MessageBag
     */
    protected $messageBag = null;

    protected $global_settings = null;

    /**
     * Initializer.
     */
    public function __construct()
    {
        $this->messageBag = new MessageBag;
        $this->global_settings = new AdminSettingsController();

    }

    public function showView($name = null)
    {

        if (View::exists('admin/' . $name)) {
            if (Sentinel::check()) {
                return view('admin.' . $name);
            } else {
                return redirect('admin/signin')->with('error', 'You must be logged in!');
            }
        } else {
            abort('404');
        }
    }


}
