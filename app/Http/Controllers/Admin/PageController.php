<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\View;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $user = Auth::user();
        $apartment = Apartment::paginate();
        $message = Message::all();
        $service = Service::all();
        $sponsorship = Sponsorship::all();
        $view = View::all();

        return view('admin.dashboard', [
            'user'          => $user,
            'apartment'     => $apartment,
            'message'       => $message,
            'service'       => $service,
            'sponsorship'   => $sponsorship,
            'view'          => $view,
        ]);
    }
}
