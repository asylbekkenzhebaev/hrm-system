<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Gender;
use App\Models\Position;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $employees = Employee::with(['position', 'position.department', 'gender'])
            ->filter()
            ->paginate(request('paginate') ?? 5)
            ->withQueryString();

        $departments = Department::query()->pluck('name', 'id')->toArray();
        $positions = Position::query()->pluck('name', 'id')->toArray();
        $genders = Gender::query()->pluck('name', 'id')->toArray();

        return view('employees.index', compact('departments', 'positions', 'genders', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $genders = Gender::all();
        $departments = Department::all();

        return view('employees.create', compact('genders', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmployeeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $position_id = $data['position_id'];
        unset($data['department_id']);
        unset($data['position_id']);
        $employee = new Employee($data);
        $employee->save();

        Position::where('id', $position_id)->update(['employee_id' => $employee->id]);

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} сотрудник успешно создан!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Employee $employee
     * @return Application|Factory|View
     */
    public function edit(Employee $employee): View|Factory|Application
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
     * @param UpdateEmployeeRequest $request
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $data = $request->validated();
        $position_id = $data['position_id'];
        unset($data['department_id']);
        unset($data['position_id']);
        $employee->update($data);

        Position::where('employee_id', $employee->id)->update(['employee_id' => null]);
        Position::where('id', $position_id)->update(['employee_id' => $employee->id]);

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} сотрудник успешно обновлен!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Employee $employee
     * @return RedirectResponse
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        Position::where('employee_id', $employee->id)->update(['employee_id' => null]);

        $employee->delete();

        return redirect()->route('employees.index')->with('status', ['text' => "{$employee->fio} сотрудник успешно удален!", 'color' => 'danger']);
    }
}
