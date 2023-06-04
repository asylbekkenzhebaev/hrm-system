<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
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
    public function index(): Factory|View|Application
    {
        $positions = Position::with('department', 'employee')
            ->filter()
            ->paginate(request('paginate') ?? 5)
            ->withQueryString();

        $departments = Department::query()->pluck('name', 'id')->toArray();
        $employees = Employee::query()->pluck('fio', 'id')->toArray();

        return view('positions.index', compact('positions', 'departments', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $departments = Department::all();
        return view('positions.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePositionRequest $request
     * @return RedirectResponse
     */
    public function store(StorePositionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $position = new Position($data);
        $position->save();

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} должность успешно создан!", 'color' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Position $position
     * @return Application|Factory|View
     */
    public function edit(Position $position): View|Factory|Application
    {
        $departments = Department::all();
        return view('positions.edit', compact('departments','position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePositionRequest $request
     * @param Position $position
     * @return RedirectResponse
     */
    public function update(UpdatePositionRequest $request, Position $position): RedirectResponse
    {
        $data = $request->validated();
        $position->update($data);

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} должность успешно обновлен!", 'color' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Position $position
     * @return RedirectResponse
     */
    public function destroy(Position $position): RedirectResponse
    {
        $position->delete();

        return redirect()->route('positions.index')->with('status', ['text' => "{$position->name} должность успешно удален!", 'color' => 'danger']);
    }


    /**
     * @param Request $request
     * @return mixed
     */
    public function positionList(Request $request)
    {
        $department_id = intval($request->department_id);
        $position_id = intval($request->position_id);

        if ($position_id) {
            $positions = Position::where('department_id', $department_id)
                ->where(function ($query) use ($position_id) {
                $query->whereNull('employee_id')
                    ->orWhere('id', $position_id);
            })->get();
        } else {
            $positions = Position::where('department_id', $department_id)
            ->whereNull('employee_id')
            ->get();
        }

        return $positions;
    }
}
