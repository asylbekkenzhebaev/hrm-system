<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenderRequest;
use App\Http\Requests\UpdateGenderRequest;
use App\Models\Gender;

class GenderController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genders = Gender::all();

        return view('genders.index', compact('genders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('genders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreGenderRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreGenderRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $gender = new Gender($data);
        $gender->save();

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} gender successfully created!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Gender $gender
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Gender $gender): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('genders.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateGenderRequest $request
     * @param \App\Models\Gender $gender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenderRequest $request, Gender $gender): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $gender->update($data);

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} gender successfully updated!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Gender $gender
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Gender $gender): \Illuminate\Http\RedirectResponse
    {
        $gender->delete();

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} gender successfully deleted!", 'color' => 'danger']);
    }
}
