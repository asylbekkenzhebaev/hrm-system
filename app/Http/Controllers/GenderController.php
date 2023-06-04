<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenderRequest;
use App\Http\Requests\UpdateGenderRequest;
use App\Models\Gender;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $genders = Gender::filter()
            ->paginate(request('paginate') ?? 5)
            ->withQueryString();

        return view('genders.index', compact('genders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('genders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGenderRequest $request
     * @return RedirectResponse
     */
    public function store(StoreGenderRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $gender = new Gender($data);
        $gender->save();

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} пол успешно создан!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Gender $gender
     * @return Application|Factory|View
     */
    public function edit(Gender $gender): View|Factory|Application
    {
        return view('genders.edit', compact('gender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGenderRequest $request
     * @param Gender $gender
     * @return RedirectResponse
     */
    public function update(UpdateGenderRequest $request, Gender $gender): RedirectResponse
    {
        $data = $request->validated();
        $gender->update($data);

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} пол успешно обновлен!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Gender $gender
     * @return RedirectResponse
     */
    public function destroy(Gender $gender): RedirectResponse
    {
        $gender->delete();

        return redirect()->route('genders.index')->with('status', ['text' => "{$gender->name} пол успешно удален!", 'color' => 'danger']);
    }
}
