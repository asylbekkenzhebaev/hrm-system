@extends('layouts/app')

@section('content')

    @if(session('status'))
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <div class="alert alert-{{session('status')['color']}}" role="alert">
                    {{session('status')['text']}}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            <h3>Штатная структура</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('positions.create')}}" class="btn btn-success btn-lg float-end">Создать новую должность
                    <i
                        class="bi bi-plus-square"></i></a>

            </div>
        @endif
    </div>

    <form action="{{ route('positions.index') }}" id="search" method="GET"></form>

    <div class="row mt-2">
        <table id="positions-table" class="table table-stripped">
            <thead>
            <tr>
                <th>#</th>
                <th>Должность</th>
                <th>Отдел</th>
                <th>Сотрудник</th>
                <th><span class="fr-7">***</span></th>
            </tr>
            <tr>
                <th>
                    <div class="input-group">
                        <input
                            type="text"
                            name="id"
                            form="search"
                            value="{{ Request::get('id') }}"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Поиск по идентификатору"
                        >
                        <button data-name="id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <input
                            type="text"
                            name="name"
                            form="search"
                            value="{{ Request::get('name') }}"
                            class="form-control"
                            autocomplete="off"
                            placeholder="Поиск по должности"
                        >
                        <button data-name="name" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select
                            form="search"
                            name="department_id"
                            class="form-select"
                        >
                            <option value="">Выберите отдел</option>
                            @foreach($departments as $id => $department)
                                <option
                                    value="{{ $id }}" @selected($id == Request::get('department_id'))>{{ $department }}</option>
                            @endforeach
                        </select>
                        <button data-name="department_id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select
                            form="search"
                            name="employee_id"
                            class="form-select"
                        >
                            <option value="">Выберите сотрудника</option>
                            @foreach($employees as $id => $employee)
                                <option
                                    value="{{ $id }}" @selected($id == Request::get('employee_id'))>{{ $employee }}</option>
                            @endforeach
                        </select>
                        <button data-name="employee_id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th>
                    <div class="input-group">
                        <select
                            form="search"
                            name="paginate"
                            class="form-select"
                        >
                            <option value="">Показать записей</option>
                            <option value="10" @selected(10 == Request::get('paginate'))>10</option>
                            <option value="25" @selected(25 == Request::get('paginate'))>25</option>
                            <option value="50" @selected(50 == Request::get('paginate'))>50</option>
                            <option value="100" @selected(100 == Request::get('paginate'))>100</option>
                        </select>
                        <button data-name="paginate" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($positions as $position)
                <tr>
                    <td>{{$position->id}}</td>
                    <td>{{$position->name}}</td>
                    <td>{{$position->department->name}}</td>
                    <td>{{$position->employee->fio ?? 'Должность вакантна'}}</td>
                    <td>
                        @if (Auth::check())
                            <a href="{{route('positions.edit', ['position'=>$position])}}"
                               class="btn btn-light btn-lg float-end" title="Редактировать должность"><i
                                    class="bi bi-pencil-square"></i></a>

                            <form action="{{route('positions.destroy', $position)}}" method="POST" class="float-end"
                                  title="Удалить должность">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">
                        {{ $positions->links() }}
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>


@endsection
