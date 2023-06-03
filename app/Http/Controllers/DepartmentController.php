<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $departments = Department::all();

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreDepartmentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreDepartmentRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $department = new Department($data);
        $department->save();

        return redirect()->route('departments.index')->with('status', ['text' => "{$department->name} department successfully created!", 'color' => 'success']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Department $department): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDepartmentRequest $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $department->update($data);

        return redirect()->route('departments.index')->with('status', ['text' => "{$department->name} department successfully updated!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Department $department): \Illuminate\Http\RedirectResponse
    {
        $department->delete();

        return redirect()->route('departments.index')->with('status', ['text' => "{$department->name} department successfully deleted!", 'color' => 'danger']);
    }
}
