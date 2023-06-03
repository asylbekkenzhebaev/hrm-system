<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $positions = Position::with('department')->whereNull('employee_id')->get();

        return view('home', compact('positions'));
    }
}
