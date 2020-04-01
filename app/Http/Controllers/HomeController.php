<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
        $keyword = $request->get('search');
        $perPage = 1;

        if (!empty($keyword)) {
            $users = \App\User::where('name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->paginate($perPage);
        } else {
            $users = \App\User::paginate($perPage);
        }


        return view('home', compact('users'));
    }

}
