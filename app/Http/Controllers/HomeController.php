<?php

namespace App\Http\Controllers;

use App\Models\Department;
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
        $this->middleware(['auth'])->except(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $positions = Position::with('department')
            ->filter()
            ->paginate(request('paginate') ?? 5)
            ->withQueryString();

        $departments = Department::query()->pluck('name', 'id')->toArray();

        return view('home', compact('departments','positions'));
    }
}
