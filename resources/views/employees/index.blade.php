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
            <h3>Сотрудники</h3>
        </div>
        @if (Auth::check())
            <div class="col-6">
                <a href="{{route('employees.create')}}" class="btn btn-success btn-lg float-end">Создать нового сотрудника<i
                        class="bi bi-plus-square"></i></a>

            </div>
        @endif
    </div>

    <form action="{{ route('employees.index') }}" id="search" method="GET"></form>

    <div class="row mt-2">
        <table id="employees-table" class="table table-stripped table-datatable">
            <thead>
            <tr>
                <th>#</th>
                <th>ФИО</th>
                <th>День рождения</th>
                <th>Пол</th>
                <th>Отдел</th>
                <th>Должность</th>
                <th><span class="fr-21">***</span></th>
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
                            placeholder="Поиск по ФИО"
                        >
                        <button data-name="name" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th></th>
                <th>
                    <div class="input-group">
                        <select
                            form="search"
                            name="gender_id"
                            class="form-select"
                        >
                            <option value="">Выберите пол</option>
                            @foreach($genders as $id => $gender)
                                <option
                                    value="{{ $id }}" @selected($id == Request::get('gender_id'))>{{ $gender }}</option>
                            @endforeach
                        </select>
                        <button data-name="gender_id" class="btn btn-outline-danger clean-input">
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
                            name="position_id"
                            class="form-select"
                        >
                            <option value="">Выберите должность</option>
                            @foreach($positions as $id => $position)
                                <option
                                    value="{{ $id }}" @selected($id == Request::get('position_id'))>{{ $position }}</option>
                            @endforeach
                        </select>
                        <button data-name="position_id" class="btn btn-outline-danger clean-input">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $employee)
                <tr>
                    <td>{{$employee->id}}</td>
                    <td>{{$employee->fio}}</td>
                    <td>{{date('d-m-Y', strtotime($employee->birthday))}}</td>
                    <td>{{$employee->gender->name ?? 'не найден'}}</td>
                    <td>{{$employee->position->department->name ?? 'не найден'}}</td>
                    <td>{{$employee->position->name ?? 'не найден'}}</td>
                    <td>

                        @if (Auth::check())
                            <form action="{{route('employees.destroy', $employee)}}" method="POST" class="float-end"
                                  title="Удалить сотрудника">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light btn-lg"><i class="bi bi-trash3"></i></button>
                            </form>
                            <a href="{{route('employees.edit', ['employee'=>$employee])}}"
                               class="btn btn-light btn-lg float-end" title="Редактировать сотрудника"><i
                                    class="bi bi-pencil-square"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
