<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
        $employees = Employee::with(['position', 'position.department', 'gender'])->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genders = Gender::all();
        $departments = Department::all();

        return view('employees.create', compact('genders', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreEmployeeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreEmployeeRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $position_id = $data['position_id'];
        unset($data['department_id']);
        unset($data['position_id']);
        $employee = new Employee($data);
        $employee->save();

        Position::where('id', $position_id)->update(['employee_id' => $employee->id]);

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} employee successfully created!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Employee $employee): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $genders = Gender::all();
        $departments = Department::all();
        $positions = Position::all();
        $employee_position = DB::table('positions')->where('employee_id', $employee->id)->select('id', 'department_id')->get();
        $employee_position = json_decode(json_encode($employee_position));

        if ($employee_position) {
            $employee_position = $employee_position[0];
        }

        return view('employees.edit', compact('employee', 'genders', 'departments', 'positions', 'employee_position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateEmployeeRequest $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $position_id = $data['position_id'];
        unset($data['department_id']);
        unset($data['position_id']);
        $employee->update($data);

        Position::where('employee_id', $employee->id)->update(['employee_id' => null]);
        Position::where('id', $position_id)->update(['employee_id' => $employee->id]);

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} employee successfully updated!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Employee $employee): \Illuminate\Http\RedirectResponse
    {
        Position::where('employee_id', $employee->id)->update(['employee_id' => null]);

        $employee->delete();

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} employee successfully deleted!", 'color' => 'danger']);
    }
}
